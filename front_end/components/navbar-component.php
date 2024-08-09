<?php
session_start();
if (isset($_SESSION['userId'])) {
    $userRole = $_SESSION['userRole'];
    switch ($userRole) {
        case "user":
            function displayStatus()
            {
                echo "<h3 class='welcome-message'>Welcome, "
                . htmlspecialchars($_SESSION['userName']) . "!</h3>";
                echo "<button class='logout-button'>Logout</button>";
            }
            break;
        case "teacher":
            function displayStatus()
            {
                echo "<h3 class='welcome-message'>Welcome, <br>"
                . htmlspecialchars($_SESSION['userName']) . "!</h3>";
                echo "<button class='logout-button'>Logout</button>";

                echo "<div class='dropdown-wrapper'>";
                echo "    <button class='dropdown-button'>Dropdown</button>";
                echo "    <div id='dropdown' class='dropdown-content'>";
                echo "        <a href='1'>Link 1</a>";
                echo "        <a href='2'>Link 2</a>";
                echo "        <a href='3'>Link 3</a>";
                echo "    </div>";
                echo "</div>" ;
            }
            break;
        case "admin":
            function displayStatus()
            {
                echo "<h3 class='welcome-message'>Welcome, <br>"
                . htmlspecialchars($_SESSION['userName']) . "!</h3>";
                echo "<button class='logout-button'>Logout</button>";

                echo "<div class='dropdown-wrapper'>";
                echo "    <button class='dropdown-button'>Dropdown</button>";
                echo "    <div id='dropdown' class='dropdown-content'>";
                echo "        <a href='1'>Link 1</a>";
                echo "        <a href='2'>Link 2</a>";
                echo "        <a href='3'>Link 3</a>";
                echo "    </div>";
                echo "</div>" ;               
            }
            break;
    }
} else {
    function displayStatus()
    {
        echo "<button class='login-button'>Login</button>";
        echo "<button class='register-button'>REGISTER NOW</button>";
    }
}
?>
<nav>
    <div class="logo-contaier">
        <h1 id="logo">Literature Hub</h1>
    </div>
    <div class="navigation-links"></div>
    <div class="user-status">
        <?php displayStatus() ?>
    </div>
</nav>