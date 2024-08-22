<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confPassword = $_POST["conf-password"];

    if(empty($email) ||  empty($username) || empty($password) || empty($confPassword)) {
        header("Location: ../markup/register.php?error=emptyfields");
        die();
    }
    if($password != $confPassword){
        header("Location: ../markup/register.php?error=passwordsmatch");
        die();
    }
    try {
        require_once "../config/database.php";

        $sqlSelect = "SELECT * FROM users WHERE user_email = :email;";

        $stmt = $pdo->prepare($sqlSelect);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() == 0) {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $sqlInsert = "INSERT INTO users (user_email, user_name, user_password, user_role) 
                          VALUES(:email, :username, :password, 'user');";

            $stmt2 = $pdo->prepare($sqlInsert);
           
            $stmt2->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt2->bindParam(":username", $username, PDO::PARAM_STR);            
            $stmt2->bindParam(":password", $hashPassword, PDO::PARAM_STR);

            $stmt2->execute();
            header("Location: ../markup/login.php?info=createdaccount");
            die();
        }
        else{
            header("Location: ../markup/register.php?error=userexists");
            die();
        }
    }
    catch(PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }

}
else{
    header("Location: ../markup/register.php");
}