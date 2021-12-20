const checkoutForm = document.getElementById("checkoutForm");

checkoutForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(checkoutForm);

    
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

