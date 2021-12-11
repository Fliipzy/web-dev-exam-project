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
            handleUnauthorized();
        }
    };
    
    xhttp.open("POST", "../api/authentication/signin")
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(JSON.stringify({email: formData.get("email"), password: formData.get("password")}));
});

function handleUnauthorized()
{
    document.getElementById("loginErrorMessage").removeAttribute("hidden");
}
