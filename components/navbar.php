<?php
session_start();
if (!isset($_SESSION['userId'])) {
    function displayStatus()
    {
        echo "<button class='login-button'>Login</button>";
        echo "<button class='register-button'>REGISTER NOW</button>";
    }
} else {
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

                echo <<<HTML
                <div class="dropdown-wrapper">
                    <button class="dropdown-button">Admin</button>
                    <div id="dropdown" class="dropdown-content">
                        <a href="/literature_hub/admin/">Admin panel</a>
                        <a href="2">Link 2</a>
                        <a href="3">Link 3</a>
                    </div>
                </div>
                HTML;
            }
            break;
        case "admin":
            function displayStatus()
            {
                echo "<h3 class='welcome-message'>Welcome, <br>"
                . htmlspecialchars($_SESSION['userName']) . "!</h3>";
                echo "<button class='logout-button'>Logout</button>";

                echo <<<HTML
                <div class="dropdown-wrapper">
                    <button class="dropdown-button">Admin</button>
                    <div id="dropdown" class="dropdown-content">
                        <a href="/literature_hub/admin/">Admin panel</a>
                        <a href="2">Link 2</a>
                        <a href="3">Link 3</a>
                    </div>
                </div>
                HTML;
            }
            break;
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