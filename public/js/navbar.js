function logout() {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.status == 200) {
            window.location.href = "/webexam/views/login.php";   
        }
    };
    xhttp.open("GET", "../api/authentication/signout", true);
    xhttp.send();
}