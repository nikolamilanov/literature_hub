<?php

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email) || empty($password)){
        header("Location: ../markup/login.php?error=emptyfields");
        die();
    }
    
    try{
        require_once "../config/database.php";

        $sqlSelect = "SELECT * FROM users WHERE user_email = :email;";

        $stmt = $pdo->prepare($sqlSelect);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $user['user_password'])){
                $_SESSION['userId'] = $user['user_id'];
                $_SESSION['userName'] = $user['user_name'];
                $_SESSION['userRole'] = $user['user_role'];
                $_SESSION['userEmail'] = $user['user_email'];
                header("Location: ../markup/index.php");
                die();
            }
            else{
                header("Location: ../markup/login.php?error=invalidlogin");
                die();
            }
        }
        else{
            header("Location: ../markup/login.php?error=invalidlogin");
            die();
        }

    }
    catch (PDOException $e){
        die("Query failed:" . $e->getMessage());
    }
}
else{
    header("Location: ../markup/login.php");
}