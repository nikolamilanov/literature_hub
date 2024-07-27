<?php

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email) || empty($password)){
        header("Location: ../front_end/markup/login.php?error=emptyfields");
        die();
    }
    
    try{
        require_once "database-handler.inc.php";

        $sqlSelect = "SELECT * FROM Users WHERE user_email = :email;";

        $stmt = $pdo->prepare($sqlSelect);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $user['user_password'])){
                $_SESSION['email'] = $user['user_email'];
                $_SESSION['username'] = $user['user_name'];
                $_SESSION['rolw'] = $user['user_role'];
                header("Location: ../front_end/markup/index.php");
                die();
            }
            else{
                header("Location: ../front_end/markup/login.php?error=invalidlogin");
                die();
            }
        }
        else{
            header("Location: ../front_end/markup/login.php?error=invalidlogin");
            die();
        }

    }
    catch (PDOException $e){
        die("Query failed:" . $e->getMessage());
    }
}
else{
    header("Location: ../front_end/markup/login.php");
}