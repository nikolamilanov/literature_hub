<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: /literature_hub/front_end/markup/index.php");
    die();
}

if ($_SESSION['userRole'] != "admin" && $_SESSION['userRole'] != "teacher") {
    header("Location: /literature_hub/front_end/markup/index.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $creationId = $_POST["creation-id"];
    $creation = $_POST["creation"];
    $genre = $_POST["genre"];
    $writer = $_POST["writer"];
    $date = $_POST["date"];

    try {
        require_once "../database-handler.inc.php";

        $sqlUpdate = "UPDATE creations
                     SET creation_name = :creation, creation_genre = :genre,
                         creation_writer = :writer, creation_date = :date   
                     WHERE creation_id = :id;";

        $stmt = $pdo->prepare($sqlUpdate);

        $stmt->bindParam(":id", $creationId, PDO::PARAM_INT);
        $stmt->bindParam(":creation", $creation, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $genre, PDO::PARAM_STR);
        $stmt->bindParam(":writer", $writer, PDO::PARAM_INT);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);

        $stmt->execute();


        //Insert the made change into logs
        $sqlInsertLog = "INSERT INTO changeslogs(log_timestamp, changed_by, action_type)
        VALUES(NOW(), :user_id, 'update')";

        $stmt2 = $pdo->prepare($sqlInsertLog);

        $stmt2->bindParam(":user_id", $_SESSION['userId'], PDO::PARAM_INT);

        $stmt2->execute();

        header("Location: /literature_hub/front_end/markup/index.php");

        die();

    } catch (PDOException $e) {
        header("Location: /literature_hub/front_end/markup/index.php");

        die("Query failed:" . $e->getMessage());
    }


} else {
    header("Location: /literature_hub/front_end/markup/index.php");
}