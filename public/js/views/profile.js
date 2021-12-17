const customerForm = document.getElementById("customerForm");
const passwordForm = document.getElementById("passwordForm");

customerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(customerForm);

    const updatedCustomer = {
        customerId: formData.get("customerId"),
        firstName: formData.get("firstName"),
        lastName: formData.get("lastName"),
        company: formData.get("company"),
        address: formData.get("address"),
        city: formData.get("city"),
        state: formData.get("state"),
        country: formData.get("country"),
        postalCode: formData.get("postalCode"),
        phone: formData.get("phone"),
        fax: formData.get("fax"),
        email: formData.get("email")
    }

    fetch("../api/customers", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(updatedCustomer)
    })
    .then((response) => {
        if (response.ok) {
            popmessage("customerMessage", "Your personal information was updated successfully!", "success");
        }
        else if (response.status == 400) {
            popmessage("customerMessage", "You did not update anything!", "danger");
        }
        else {
            popmessage("customerMessage", "An error happend while updating your information, try again later!", "danger");
        }
    });
});

passwordForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(passwordForm);

    fetch("../api/authentication/reset-password", {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            oldPassword: formData.get("oldPassword"),
            newPassword: formData.get("newPassword"),
            newPasswordConfirmed: formData.get("newPasswordConfirmed")
        })
    })
    .then((response) => {
        if (response.ok) {
            popmessage("passwordMessage", "Password was updated successfully!", "success");
            // clear form input text
            const inputs = passwordForm.querySelectorAll(".input-group input");
            inputs.forEach(input => input.value = "");
        }
        else if (response.status == 400) {
            popmessage("passwordMessage", "'New password' did not match 'Confirm password', try again!", "danger");
        }
        else if (response.status == 401 ) {
            popmessage("passwordMessage", "The current password you provided was wrong!", "danger");
        }
        else {
            popmessage("passwordMessage", "Password could not be changed due to server error, try again later!", "danger");
        }
    });
})