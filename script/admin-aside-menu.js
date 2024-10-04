const overviewLink = document.getElementById('overview');
const creationsLink = document.getElementById('creations');
const writersLink = document.getElementById('writers');
const logsLink = document.getElementById('logs');
const requestsLink = document.getElementById('requests');
const rolesLink = document.getElementById('roles');

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
            overviewLink.classList.add('indicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/manage-creations.php":
            creationsLink.classList.add('indicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/manage-writers.php":
            writersLink.classList.add('indicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/system-logs.php":
            logsLink.classList.add('indicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/user-requests.php":
            requestsLink.classList.add('indicate-active-page');
            break;
        case "https://localhost/literature_hub/admin/user-roles.php":
            rolesLink.classList.add('indicate-active-page');
            break;
        default:
            return;
    }
};

window.addEventListener('load', indicateActivePage());