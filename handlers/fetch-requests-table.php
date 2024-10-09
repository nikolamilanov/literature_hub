<?php
if($_SERVER['REQUEST_METHOD'] != 'GET'){
    header('Location: ../admin/user-requests.php');
    die();
}
    try{
        require_once '../config/database.php';

        $sqlSelect = 'SELECT requested_by, request_timestamp, request_status, user_name
                      FROM changes_requests
                      INNER JOIN users ON changes_requests.requested_by = users.user_id';

        $stmt = $pdo->prepare($sqlSelect);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $tableData = $stmt->fetchAll();
        } else{
            $tableData = [];
        }

        echo'
        <table class="requests-table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Request Status</th>
                <th>Request Timestamp</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($tableData as $row) {
            echo'
            <tr>
                <td>' . htmlspecialchars($row['user_name']) . '</td>
                <td>' . htmlspecialchars($row['request_status']) . '</td>
                <td>' . htmlspecialchars($row['request_timestamp'])
                      .'<div class="action-buttons"><button>button</button>
                        <button>button</button></div>
                </td>
            </tr>';
            }
            echo'
            </tbody>
            </table>';
            
        } catch (PDOException $e){
            echo 'Query failed: ' . $e->getMessage();
        }