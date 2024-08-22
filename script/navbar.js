const logo = document.getElementById("logo");
const loginButton = document.querySelector('.login-button');
const logoutButton = document.querySelector(".logout-button");
const registerButton = document.querySelector(".register-button");
const dropdownButton = document.querySelector(".dropdown-button");

logo.addEventListener("click", function () {
    window.location.href = "/literature_hub/markup/index.php";
});
if (loginButton != null) {
    loginButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/markup/login.php";
    });
}
if (registerButton != null) {
    registerButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/markup/register.php";
    });
}
if (logoutButton != null) {
    logoutButton.addEventListener("click", function () {
        window.location.href = "/literature_hub/handlers/logout.php";
    });
}
if (dropdownButton != null) {
    logoutButton.style.marginRight = 0;
    dropdownButton.addEventListener("click", function () {
        document.getElementById("dropdown").classList.toggle("display-dropdown");
    });
}
if (dropdownButton != null) {

    window.onclick = function (event) {
        if (!event.target.matches('.dropdown-button')) {
            let dropdown = document.getElementById("dropdown");
            if (dropdown.classList.contains('display-dropdown')) {
                dropdown.classList.remove('display-dropdown');
            }
        }
    }
}
