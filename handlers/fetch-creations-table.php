<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $filterType = $_GET["ftype"];
    $filterValue = $_GET["fvalue"];
    try {
        require_once "../config/database.php";

        $sqlSelect = "SELECT creations.creation_name, creations.creation_genre,
                             creations.creation_date, writers.writer_name
                      FROM creations
                      INNER JOIN writers ON creations.creation_writer = writers.writer_id ";

        switch ($filterType) {
            case "genre":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE creation_genre LIKE :filterWord AND is_deleted = 0;";
                } else {
                    $sqlSelect .= "WHERE is_deleted = 0 ORDER BY creation_genre;";
                }
                $headingOrder = array("Genre", "Creation", "Writer", "Date");
                $dataOrder = array("creation_genre", "creation_name", "writer_name", "creation_date");
                break;
            case "writer":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE writers.writer_name LIKE :filterWord AND is_deleted = 0;";
                } else {
                    $sqlSelect .= "WHERE is_deleted = 0 ORDER BY writers.writer_name;";
                }
                $headingOrder = array("Writer", "Creation", "Genre", "Date");
                $dataOrder = array("writer_name", "creation_name", "creation_genre", "creation_date");
                break;
            case "creation":
                if (!empty($filterValue)) {
                    $sqlSelect .= "WHERE creation_name LIKE :filterWord AND is_deleted = 0;";
                } else {
                    $sqlSelect .= "WHERE is_deleted = 0 ORDER BY creation_name;";
                }
                $headingOrder = array("Creation", "Genre", "Writer", "Date");
                $dataOrder = array("creation_name", "creation_genre", "writer_name", "creation_date");
                break;
        }

        $stmt = $pdo->prepare($sqlSelect);

        if (!empty($filterValue)) {
            $filterValue = '%' . $filterValue . '%';
            $stmt->bindParam(":filterWord", $filterValue, PDO::PARAM_STR);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $tableData = $stmt->fetchAll();
        } else {
            $tableData = [];
        }

        echo "<table class='creations-table'>";

        echo "<thead>";
        echo "<tr><th>$headingOrder[0]</th><th>$headingOrder[1]</th><th>$headingOrder[2]</th><th>$headingOrder[3]</th></tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($tableData as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row[$dataOrder[0]]) . "</td>";
            echo "<td>" . htmlspecialchars($row[$dataOrder[1]]) . "</td>";
            echo "<td>" . htmlspecialchars($row[$dataOrder[2]]) . "</td>";
            echo "<td>" . htmlspecialchars($row[$dataOrder[3]]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";

        echo "</table>";

    } catch (PDOException $e) {
        echo "Query failed: " . htmlspecialchars($e->getMessage());
    }
}