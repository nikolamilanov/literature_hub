<?php
    session_start();
    if(isset($_SESSION['username'])){       
        function displayStatus(){
            global $username;
            $username = $_SESSION['username'];

            echo"<h3>Welcome, $username!</h3>";
            echo"<button class='logout-button'>Logout</button>";
        }      
    }
    else{
       function displayStatus(){
        echo"<button class='login-button'>Login</button>";
        echo"<button class='register-button'>Signup</button>";
       }
    }
?>
<nav>
    <div class="logo-contaier">
        <h1>Literature Hub</h1>
    </div>
    <div class="navigation-links"></div>
    <div class="user-status">
        <?php displayStatus()?>
    </div>
</nav>