<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once '../config/database.php';

    $sqlSelect = 'SELECT FROM changes_requests()';
}