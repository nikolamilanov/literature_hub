function fetchTable(){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('table-container').innerHTML = this.responseText;

            attachEventListeners();
        }
    };
    xmlhttp.open('GET', '/literature_hub/handlers/fetch-requests-table.php');
    xmlhttp.send();
};

window.addEventListener('load', fetchTable);

function attachEventListeners(){
    document.querySelectorAll('.requests-table tbody tr')
    .forEach(row => {
        row.addEventListener('mouseenter', displayButtons)
        row.addEventListener('mouseleave', hideButtons)
    });

    document.querySelectorAll('.accept-button')
    .forEach(btn => btn.addEventListener('click', acceptRequest));

    document.querySelectorAll('.deny-button')
    .forEach(btn => btn.addEventListener('click', denyRequest));
}

function displayButtons(){
    const cells = this.querySelectorAll('.action-buttons');
    for (let i = 0; i < cells.length; i++){
        cells[i].style.visibility = 'visible';
    }
};

function hideButtons(){
    const cells = this.querySelectorAll('.action-buttons');
    for (let i =0; i < cells.length; i++){
        cells[i].style.visibility = 'hidden';
    }
};

function acceptRequest(){
    const acceptId = this.getAttribute('id');
    fetch('/literature_hub/handlers/accept-user-request.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: acceptId,
            action: 'accept'

        })       
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error("Error:", data.error);
        } else {
            console.log("Request succeeded:", data);
        }
    })
    .catch(error => console.error("Error:", error))
    .finally(() => {
        fetchTable();
    });
};

function denyRequest(){
    const denyId = this.getAttribute('id');
    console.log(denyId);
    fetch('/literature_hub/handlers/reject-user-request.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: denyId,
            action: 'reject'

        })       
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error("Error:", data.error);
        } else {
            console.log("Request succeeded:", data);
        }
    })
    .catch(error => console.error("Error:", error))
    .finally(() => {
        fetchTable();
    });
};

