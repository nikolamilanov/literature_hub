function fetchTable(){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('table-container').innerHTML = this.responseText;

            attachRowEventListeners();
        }
    };
    xmlhttp.open('GET', '/literature_hub/handlers/fetch-requests-table.php');
    xmlhttp.send();
};

window.addEventListener('load', fetchTable);

function attachRowEventListeners(){
    document.querySelectorAll('.requests-table tbody tr')
    .forEach(row => {
        row.addEventListener('mouseenter', displayButtons)
        row.addEventListener('mouseleave', hideButtons)
    });
}

function displayButtons(){
    console.log('shown');
    let cells = this.querySelectorAll('.action-buttons');
    for (let i = 0; i < cells.length; i++){
        cells[i].style.visibility = 'visible';
    }
};

function hideButtons(){
    console.log('hidded');
    let cells = this.querySelectorAll('.action-buttons');
    for (let i =0; i < cells.length; i++){
        cells[i].style.visibility = 'hidden';
    }
};

