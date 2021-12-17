setActiveNavLink();

function logout() {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.status == 200) {
            location.href = "/webexam/views/login.php";   
        }
    };
    xhttp.open("GET", "../api/authentication/signout", true);
    xhttp.send();
}

function setActiveNavLink() {
    let page = window.location.href.substring(window.location.href.lastIndexOf("/") + 1);
    switch (page) {
        case "tracks.php":
            break;
        case "dashboard.php":
            break;
        case "profile.php":
            break;
        default:
            break;
    }
}