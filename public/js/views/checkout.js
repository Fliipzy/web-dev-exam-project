const checkoutForm = document.getElementById("checkoutForm");

checkoutForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(checkoutForm);

    const country = document.getElementById("country").selectedIndex;

    // induce fake lag to simulate heavy server load
    setLoadingState(true);
    setTimeout(() => {
        fetch("../api/invoices", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                billingAddress: formData.get("address"),
                billingCity: formData.get("city"),
                billingState: "",
                billingCountry: country,
                billingPostalCode: formData.get("postalCode")
            })
        })
        .then((response) => {
            setLoadingState(false);

            if (response.ok) {
                // go to checkout complete
                window.location.replace("/webexam/views/checkout-done.php");
            }
            else {
                // pop error toast
                createToast("Error", "Order could not be processed!", "danger", "toastContainer");
            }
        })
        .catch((error) => {
            setLoadingState(false);
            // pop error toast
            createToast("Error", "Order could not be processed!", "danger", "toastContainer");
        });
    }, 2500);
    
});

// fetch cart track ids and update # item(s) text
fetch("../api/cart")
.then((response) => response.json())
.then((json) => {
    let amountOfItems = json.length;
    document.getElementById("numberOfCartItems").textContent = amountOfItems > 1 ? `${amountOfItems} items` : `${amountOfItems} item`;
});

// fetch total price from cart api and populate price texts
fetch("../api/cart/total")
.then((response) => response.json())
.then((json) => {
    let totalPrice = json.total;
    document.getElementById("subTotalPrice").textContent = totalPrice;
    document.getElementById("totalPrice").textContent = totalPrice;
});

function setLoadingState(isLoading) {
    if (isLoading) {
        // disabled form inputs & show spinner
        let formElements = checkoutForm.querySelectorAll("input, select, button");
        formElements.forEach(formElement => {
            formElement.disabled = true;
        });
    }
    else {
        // enable form inputs & hide spinner
        // disabled form inputs & show spinner
        let formElements = checkoutForm.querySelectorAll("input, select, button");
        formElements.forEach(formElement => {
            formElement.disabled = false;
        });
    }
}

