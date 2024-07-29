var loginButton = document.querySelector('.login-button');
var logoutButton = document.querySelector(".logout-button");
var registerButton = document.querySelector(".register-button");
var logo = document.getElementById("logo");

if (loginButton != null) {
    loginButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/front_end/markup/login.php";
    });
}
if (registerButton != null) {
    registerButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/front_end/markup/register.php";
    });
}
if (logoutButton != null) {
    logoutButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/back_end/logout-handler.inc.php";
    });
}

logo.addEventListener("click", function () {
    window.location.href = "/literature_hub/front_end/markup/index.php";
});