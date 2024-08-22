<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: ../markup/index.php");
    die();
}

if ($_SESSION['userRole'] != "admin" && $_SESSION['userRole'] != "teacher") {
    header("Location: ../markup/index.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $creation = $_POST["creation"];
    $genre = $_POST["genre"];
    $writer = $_POST["writer"];
    $date = $_POST["date"];

    try {
        require_once "../config/database.php";

        $pdo->beginTransaction();

        // Insert a new record into the 'creations' table
        $sqlInsert = "INSERT INTO creations(creation_name, creation_genre, creation_writer, creation_date, is_deleted)
                      VALUES(:creation, :genre, :writer, :date, 0);";
        $stmt = $pdo->prepare($sqlInsert);

        $stmt->bindParam(":creation", $creation, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $genre, PDO::PARAM_STR);
        $stmt->bindParam(":writer", $writer, PDO::PARAM_INT);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);

        $stmt->execute();

        // Get the last inserted creation_id for later use
        $creationId = $pdo->lastInsertId();

        // Insert a log entry into the 'changes_logs' table for the action
        $sqlInsertLog = "INSERT INTO changes_logs(log_timestamp, changed_by, action_type)
                         VALUES(NOW(), :user_id, 'create');";
        $stmt2 = $pdo->prepare($sqlInsertLog);

        $stmt2->bindParam(":user_id", $_SESSION['userId'], PDO::PARAM_INT);

        $stmt2->execute();

        // Get the last inserted log_id for later use
        $logId = $pdo->lastInsertId();

        // Insert a relation entry into 'creations_changes_list' to link the log with the creation record
        $sqlInsertLogRelation = "INSERT INTO creations_changes_list(record_id, log_id)
                                 VALUES(:creation_id, :log_id);";
        $stmt3 = $pdo->prepare($sqlInsertLogRelation);
        
        $stmt3->bindParam(":creation_id", $creationId, PDO::PARAM_INT);
        $stmt3->bindParam(":log_id", $logId, PDO::PARAM_INT);

        $stmt3->execute();

        // Commit the transaction if everything executed correctly
        $pdo->commit();

        header("Location: ../markup/index.php");

        die();

    } catch (PDOException $e) {
        // Rollback the transaction in case of an error
        $pdo->rollBack();

        header("Location: ../markup/index.php");
        die("Query failed" . $e->getMessage());
    }

} else {
    header("Location: ../markup/index.php");
}