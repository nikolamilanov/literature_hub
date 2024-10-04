const overviewLink = document.getElementById('overview');
const creationsLink = document.getElementById('creations');
const writersLink = document.getElementById('writers');
const logsLink = document.getElementById('logs');
const requestsLink = document.getElementById('requests');
const rolesLink = document.getElementById('roles');

window.onload = function(){
    indicateActivePage(); 
};

function indicateActivePage(){
    overviewLink.classList.remove('idicate-active-page');
    creationsLink.classList.remove('idicate-active-page');
    writersLink.classList.remove('idicate-active-page');
    logsLink.classList.remove('idicate-active-page');
    requestsLink.classList.remove('idicate-active-page');
    rolesLink.classList.remove('idicate-active-page');

    let currentUrl = window.location.href;

    switch(currentUrl){
        case "https://localhost/literature_hub/admin/":
            overviewLink.classList.add('idicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/manage-creations.php":
            creationsLink.classList.add('idicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/manage-writers.php":
            writersLink.classList.add('idicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/system-logs.php":
            logsLink.classList.add('idicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/user-requests.php":
            requestsLink.classList.add('idicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/user-roles.php":
            rolesLink.classList.add('idicate-active-page');
            break;
        default:
            return;
    }
};