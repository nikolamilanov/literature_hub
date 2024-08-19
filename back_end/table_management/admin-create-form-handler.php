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
    $creation = $_POST["creation"];
    $genre = $_POST["genre"];
    $writer = $_POST["writer"];
    $date = $_POST["date"];

    try {
        require_once "../database-handler.inc.php";

        $sqlInsert = "INSERT INTO creations(creation_name, creation_genre, creation_writer, creation_date)
                      VALUES(:creation, :genre, :writer, :date);";

        $stmt = $pdo->prepare($sqlInsert);

        $stmt->bindParam(":creation", $creation, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $genre, PDO::PARAM_STR);
        $stmt->bindParam(":writer", $writer, PDO::PARAM_INT);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);

        $stmt->execute();

        
        //Insert the made change into logs
        $sqlInsertLog = "INSERT INTO changeslogs(log_timestamp, changed_by, action_type)
        VALUES(NOW(), :user_id, 'create')";

        $stmt2 = $pdo->prepare($sqlInsertLog);

        $stmt2->bindParam(":user_id", $_SESSION['userId'], PDO::PARAM_INT);

        $stmt2->execute();

        header("Location: /literature_hub/front_end/markup/");

        die();

    } catch (PDOException $e) {
        header("Location: /literature_hub/front_end/markup/index.php?error");

        die("Query failed" . $e->getMessage());
    }

} else {
    header("Location: /literature_hub/front_end/markup/index.php");
}