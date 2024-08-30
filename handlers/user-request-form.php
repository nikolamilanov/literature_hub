<?php
session_start();

if(!isset($_SESSION['userId'])){
    header("Location: ../markup/index.php?1");
    die();
}
if($_SESSION['userRole'] != "user"){
    header("Location: ../markup/index.php?2");
    die();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $creation = $_POST['creation'];
    $genre = $_POST['genre'];
    $writer = $_POST['writer'];
    $date = $_POST['date'];

    try{
        require_once "../config/database.php";

        $sqlInsert = "INSERT INTO changes_requests(requested_by, request_timestamp, request_status,
                                                   temp_creation, temp_genre, temp_writer, temp_date)
                      VALUES (:user_id, NOW(), 'pending', :creation, :genre, :writer, :date);";
        $stmt = $pdo->prepare($sqlInsert);

        $stmt->bindParam(':user_id', $_SESSION['userId'], PDO::PARAM_INT);
        $stmt->bindParam(':creation', $creation, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':writer', $writer, PDO::PARAM_INT);
        $stmt->bindParam(":date", $date, PDO::PARAM_INT);

        $stmt->execute();

        header("Location: ../markup/index.php?info=successfulrequest");
        die();
       
    } catch (PDOException $e){
        header("Location: ../markup/index.php");
        die("Query failed: " . $e->getMessage());
    }

}