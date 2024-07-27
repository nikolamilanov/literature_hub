<?php
    session_start();
    if(isset($_SESSION['username'])){       
        function displayStatus(){
            global $username;
            $username = $_SESSION['username'];

            echo"<h3>Welcome, $username!</h3>";
            echo"<p>Click <a href='../../back_end/logout-handler.inc.php'>here</a> to logout</p>";
        }      
    }
    else{
       function displayStatus(){
        echo"<h3>Access denied!</h3>";
        echo"<p>Click <a href='login.php'>here</a> to login</p>";
        echo"<p>Click <a href='register.php'>here</a> to register</p>";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet"href="../style/style.css">
</head>

<body>
    <div class="status-panel">
        <?php
        displayStatus();
        ?>

    </div>
</body>

</html>