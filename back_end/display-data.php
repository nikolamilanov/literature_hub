<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $filterType = $_GET["ftype"];
    $filterValue = $_GET["fvalue"];
    try {
        require_once "database-handler.inc.php";
    
        $sqlSelect = "SELECT creations.creation_name, creations.creation_genre,
             creations.creation_date, writers.writer_name
             FROM creations
             INNER JOIN writers ON creations.creation_writer = writers.writer_id ";
    
        switch ($filterType) {
            case "genre":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE creation_genre LIKE :filterWord;";
                } else {
                    $sqlSelect .= "ORDER BY creation_genre;";
                }
                break;
            case "writer":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE writers.writer_name LIKE :filterWord;";
                } else {
                    $sqlSelect .= "ORDER BY writers.writer_name;";
                }
                break;
            case "creation":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE creation_name LIKE :filterWord;";
                } else {
                    $sqlSelect .= "ORDER BY creation_name;";
                }
                break;
        }
    
        $stmt = $pdo->prepare($sqlSelect);
    
        if (!empty($filterValue)) {
            $filterValue = '%' . $filterValue .'%';
            $stmt->bindParam(":filterWord", $filterValue, PDO::PARAM_STR);
        }
    
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $tableData = $stmt->fetchAll();
        } else{
            $tableData = [];
        }
    
        //needs to be fetched using AJAX
        echo "<table border='1'>";
        echo "<tr><th>Creation</th><th>Genre</th><th>Date</th><th>Writer</th></tr>";
    
        foreach ($tableData as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['creation_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['creation_genre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['creation_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['writer_name']) . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
         
    } catch (PDOException $e) {
        echo "Query failed: " . htmlspecialchars($e->getMessage());
    }
}