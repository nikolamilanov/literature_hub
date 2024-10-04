function fetchTable(){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('table-container').innerHTML = this.responseText;
        }
    };
    xmlhttp.open('GET', '/literature_hub/handlers/fetch-requests-table.php');
    xmlhttp.send();
};

window.addEventListener('load', fetchTable());