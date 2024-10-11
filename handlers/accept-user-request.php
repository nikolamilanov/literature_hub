<?php
session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    die();
}
    $requestData = json_decode(file_get_contents('php://input'), true);
    if(!isset($requestData['id'], $requestData['action'])){
        echo json_encode(['error' => 'Invalid data']);
        die();
    }
    $id = $requestData['id'];
    $action = $requestData['action'];
    if($action != 'accept'){
        echo json_encode(['error' => 'Unexpected action']);
        die();
    }


    try{
        require_once '../config/database.php';

        $pdo->beginTransaction();

        $sqlSelect = "SELECT requested_by, temp_creation, temp_genre, temp_writer, temp_date
                      FROM changes_requests
                      WHERE request_id = :id;";
        $stmt = $pdo->prepare($sqlSelect);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        
        if($stmt->rowCount() > 0){
            $requestData = $stmt->fetch(PDO::FETCH_ASSOC);
        } else{
            echo json_encode(['error' => 'No matching request found']);
            $pdo->rollBack(); 
            return;
        }

        $sqlUpdateRequest = "UPDATE changes_requests
                              SET request_status = 'approved'
                              WHERE request_id = :id;";
        $stmt2 = $pdo->prepare($sqlUpdateRequest);

        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt2->execute();

        // Insert a new record into the 'creations' table
        $sqlInsert = "INSERT INTO creations(creation_name, creation_genre, creation_writer, creation_date, is_deleted)
                      VALUES(:creation, :genre, :writer, :date, 0);";
        $stmt3 = $pdo->prepare($sqlInsert);

        $stmt3->bindParam(":creation", $requestData['temp_creation'], PDO::PARAM_STR);
        $stmt3->bindParam(":genre", $requestData['temp_genre'], PDO::PARAM_STR);
        $stmt3->bindParam(":writer", $requestData['temp_writer'], PDO::PARAM_INT);
        $stmt3->bindParam(":date", $requestData['temp_date'], PDO::PARAM_STR);

        $stmt3->execute();

        // Get the last inserted creation_id for later use
        $creationId = $pdo->lastInsertId();

        // Insert a log entry into the 'changes_logs' table for the action
        $sqlInsertLog = "INSERT INTO changes_logs(log_timestamp, changed_by, approved_by, action_type)
        VALUES(NOW(), :user_id, :approve_id, 'create');";
        $stmt4 = $pdo->prepare($sqlInsertLog);

        $stmt4->bindParam(":user_id", $requestData['requested_by'], PDO::PARAM_INT);
        $stmt4->bindParam(":approve_id", $_SESSION['userId'], PDO::PARAM_INT);


        $stmt4->execute();

        // Get the last inserted log_id for later use
        $logId = $pdo->lastInsertId();

        // Insert a relation entry into 'creations_changes_list' to link the log with the creation record
        $sqlInsertLogRelation = "INSERT INTO creations_changes_list(record_id, log_id)
                VALUES(:creation_id, :log_id);";
        $stmt5 = $pdo->prepare($sqlInsertLogRelation);

        $stmt5->bindParam(":creation_id", $creationId, PDO::PARAM_INT);
        $stmt5->bindParam(":log_id", $logId, PDO::PARAM_INT);

        $stmt5->execute();

        // Commit the transaction if everything executed correctly
        $pdo->commit();

        echo json_encode(['success' => true]);

    }catch( PDOException $e){
        $pdo->rollBack();

        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    }
