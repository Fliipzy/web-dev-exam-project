if (window.location.hash == "#redirect") {
    popmessage("message-login-first", "Whoa, please login before you use TuneStore™!", "success");
}

const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(loginForm);
    
    const xhttp = new XMLHttpRequest();
    
    xhttp.onload = function() {
        if (this.status == 200) {
            location.reload();
        }
        else {
            popmessage("message-error", "Login credentials were wrong, please try again!", "danger");
        }
    };
    
    xhttp.open("POST", "../api/authentication/signin")
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(JSON.stringify({email: formData.get("email"), password: formData.get("password")}));
});

