const signUpForm = document.getElementById("signUpForm");

signUpForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(signUpForm);

    // do some frontend validation first
    if (formData.get("password") != formData.get("confirmedPassword")) {
        popmessage("message", "Passwords did not match, try again!", "danger");
    }
    else {
        fetch("../api/authentication/signup", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                firstName: formData.get("firstName"),
                lastName: formData.get("lastName"),
                email: formData.get("email"),
                password: formData.get("password"),
                confirmedPassword: formData.get("confirmedPassword")
            })
        })
        .then((response) => {
            // session for user has been created backend, now redirect to home.php page
            if (response.ok) {
                location.reload();
            }
            else {
                switch (response.status) {
                    case 400:
                        popmessage("message", "Passwords did not match, try again!", "danger");
                        break;
                    case 409:
                        popmessage("message", "User with that email already exists, are you already signed up?", "danger");
                        break;
                    default:
                        popmessage("message", "Server could not be reached, try signing up later!", "danger");
                        break;
                }
            }
        });
    }
});