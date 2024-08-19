<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $creationId = $_POST["creation-id"];
    $creation = $_POST["creation"];
    $genre = $_POST["genre"];
    $writer = $_POST["writer"];
    $date = $_POST["date"];

    try{
        require_once "../database-handler.inc.php";

        $sqlUpdate = "UPDATE creations
                     SET creation_name = :creation, creation_genre = :genre,
                         creation_writer = :writer, creation_date = :date   
                     WHERE creation_id = :id;";

        $stmt = $pdo->prepare($sqlUpdate);

        $stmt->bindParam(":id", $creationId, PDO::PARAM_INT);
        $stmt->bindParam(":creation" , $creation, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $genre, PDO::PARAM_STR);
        $stmt->bindParam(":writer", $writer, PDO::PARAM_INT);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: /literature_hub/front_end/markup/index.php");

        die();

    } catch (PDOException $e){
        header("Location: /literature_hub/front_end/markup/index.php");
        
        die ("Query failed:" . $e->getMessage());
    }


} else{
    header("Location: /literature_hub/front_end/markup/index.php");
}