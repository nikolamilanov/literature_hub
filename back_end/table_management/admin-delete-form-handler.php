<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $creationId = $_POST["creation-id"];

    try{
        require_once "../database-handler.inc.php";

        $sqlDelete = "DELETE FROM creations WHERE creation_id = :id;";

        $stmt = $pdo->prepare($sqlDelete);

        $stmt->bindParam(":id", $creationId, PDO::PARAM_INT);

        $stmt->execute();

        header("Location: /literature_hub/front_end/markup/index.php");

        die();

    } catch(PDOException $e){
        header("Location: /literature_hub/front_end/markup/index.php");
        
        die("Query failed:" . $e->getMessage());
    }

} else {
    header("Location: /literature_hub/front_end/markup/index.php");
}