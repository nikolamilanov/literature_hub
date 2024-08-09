var logo = document.getElementById("logo");
var loginButton = document.querySelector('.login-button');
var logoutButton = document.querySelector(".logout-button");
var registerButton = document.querySelector(".register-button");
var dropdownButton = document.querySelector(".dropdown-button");

logo.addEventListener("click", function () {
    window.location.href = "/literature_hub/front_end/markup/index.php";
});
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
if(dropdownButton != null){
    logoutButton.style.marginRight = 0;
    dropdownButton.addEventListener("click", function(){
        document.getElementById("dropdown").classList.toggle("display-dropdown");
    });
}
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button')) {
      var dropdown = document.getElementById("dropdown");
        if (dropdown.classList.contains('display-dropdown')) {
            dropdown.classList.remove('display-dropdown');
        }  
    }
  }
