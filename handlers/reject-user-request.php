<?php
session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo json_encode(['error' => 'Invalid request method']);
    die();
}
if (!isset($_SESSION['userId'])){
    echo json_encode(['error' => 'Unauthorized access']);
    die();
}
if ($_SESSION['userRole'] != 'admin' && $_SESSION['userRole'] != 'teacher') {
    echo json_encode(['error' => 'Access denied']);
    die();
}

$requestData = json_decode(file_get_contents('php://input'), true);
if(!isset($requestData['id'], $requestData['action'])){
    echo json_encode(['error' => 'Invalid data']);
    die();
}
$id = $requestData['id'];
$action = $requestData['action'];

if($action != 'reject'){
    echo json_encode(['error' => 'Unexpected action']);
    die();
}
try{
    require_once '../config/database.php';

    $sqlUpdate = "UPDATE changes_requests
                  SET request_status = 'rejected'
                  WHERE request_id = :id;";
    $stmt = $pdo->prepare($sqlUpdate);

    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    $stmt->execute();

    echo json_encode(['success' => true]);
} catch(PDOException $e){
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
}