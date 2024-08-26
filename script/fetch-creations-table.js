function filterData(filterType, filterValue) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/literature_hub/handlers/fetch-creations-table.php?ftype=" + filterType + "&fvalue=" + encodeURIComponent(filterValue), true);
    xmlhttp.send();
};

var filterForm = document.getElementById("filter-form");
filterForm.addEventListener("submit", function (event) {
    event.preventDefault();
    let filterType = document.getElementById("filter-type").value;
    let filterValue = document.getElementById("filter-value").value;

    filterData(filterType, filterValue);
});
window.onload = function(){
    let defaultFilterType = "creation";
    let defaultFilterValue = "";

    filterData(defaultFilterType, defaultFilterValue);
    if (!localStorage.getItem("alertShown")) {
        setTimeout(function() {
            alert('Login is required to use the website! \n\nThere are three available roles: user, teacher, and admin. \nPlease enter the name of the role as the credentials for testing. \n(e.g., the email and password for admin are both "admin").');
            localStorage.setItem("alertShown", "true");
        }, 2000);
    }
};