const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(loginForm);
    
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/authentication/signin")
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(JSON.stringify({email: formData.get("email"), password: formData.get("password")}));

    xhr.onload = function() {
        if (this.status == 200) {
            location.reload();
        }
        else {
            handleUnauthorized();
        }
    };
});

function handleUnauthorized()
{
    document.getElementById("loginErrorMessage").removeAttribute("hidden");
}
