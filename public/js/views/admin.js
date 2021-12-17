const adminLoginForm = document.getElementById("adminLoginForm");

adminLoginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(adminLoginForm);

    fetch("../api/authentication/admin-signin", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({password: formData.get("password")})
    })
    .then((response) => {
        // login was successful
        if (response.ok) {
            location.reload();
        }
        else {
            popmessage("message", "Wrong password, maybe you're not supposed to be here!", "danger");
        }
    });
});