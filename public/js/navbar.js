function logout() {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.status == 200) {
            location.reload();   
        }
    };
    xhttp.open("GET", "../api/authentication/signout", true);
    xhttp.send();
}