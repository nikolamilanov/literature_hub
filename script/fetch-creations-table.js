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
};