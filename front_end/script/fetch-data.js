function filterData(filterType, filterValue) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/literature_hub/back_end/display-data.php?ftype=" + filterType + "&fvalue=" + encodeURIComponent(filterValue), true);
    xmlhttp.send();
};

var filterForm = document.getElementById("filter");
filterForm.addEventListener("submit", function (event) {
    event.preventDefault();
    var ftype = document.getElementById("filter-type").value;
    var fvalue = document.getElementById("filter-value").value;

    filterData(ftype, fvalue);
});