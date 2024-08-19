<?php
session_start();

if(!isset($_SESSION['userId'])){
    header("Location: /literature_hub/front_end/markup/index.php");
    die();
}

if($_SESSION['userRole'] != "admin"){
    header("Location: /literature_hub/front_end/markup/index.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $creationId = $_POST["creation-id"];

    try{
        require_once "../database-handler.inc.php";

        $sqlDelete = "DELETE FROM creations WHERE creation_id = :id;";

        $stmt = $pdo->prepare($sqlDelete);

        $stmt->bindParam(":id", $creationId, PDO::PARAM_INT);

        $stmt->execute();

        
        //Insert the made change into logs
        $sqlInsertLog = "INSERT INTO changeslogs(log_timestamp, changed_by, action_type)
                         VALUES(NOW(), :user_id, 'delete')";
        
        $stmt2 = $pdo->prepare($sqlInsertLog);

        $stmt2->bindParam(":user_id", $_SESSION['userId'], PDO::PARAM_INT);

        $stmt2->execute();

        header("Location: /literature_hub/front_end/markup/index.php");

        die();

    } catch(PDOException $e){
        header("Location: /literature_hub/front_end/markup/index.php");
        
        die("Query failed:" . $e->getMessage());
    }

} else {
    header("Location: /literature_hub/front_end/markup/index.php");
}