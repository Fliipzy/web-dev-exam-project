// variables for cart view
let cartTracks = [];

// if script is being executed from cart.php
if (window.location.href.substring(window.location.href.lastIndexOf("/") + 1) == "cart.php") {
    const ROWS_PER_PAGE = 10;
    let currentPage = 0;

    const table = document.getElementById("cartTable");
    const tbody = table.getElementsByTagName("tbody")[0];

    // update shopping cart table
    getCartTracks();

    
    function addTableRows() {
        if (cartTracks.length > 0) {
            table.hidden = false;
            
            for (let i = currentPage * ROWS_PER_PAGE; i < (currentPage + 1) * ROWS_PER_PAGE; i++) {
                if (i < cartTracks.length) {
                    let row = document.createElement("tr");
                    row.innerHTML = 
                    `<td>${cartTracks[i].Name}</td>` + 
                    `<td>${cartTracks[i].UnitPrice} $</td>` +
                    `<td><button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></td>`;
                    tbody.append(row);
                }
                else {
                    break;
                }
            }
            // update sub total
            document.getElementById("subTotal").innerHTML = `<b>Sub-total:</b> ${getCartTotal()} $`;
        }
        else {
            table.hidden = true;
        }
        
    }

    async function getCartTracks() {
        let response = await fetch(`../api/cart`)
            .then(response => response.json());
    
        // for each track id, fetch track and add it to tracks
        for (let i = 0; i < response.length; i++) {
            let track = await fetch(`../api/tracks/${response[i]}}`)
                .then(response => response.json());

            cartTracks.push(track);
        }
        addTableRows();
    }

    function getCartTotal() {
        let sum = 0;
        for (const track of cartTracks) {
            sum += parseFloat(track.UnitPrice);
        }
        return sum.toFixed(2);
    }
}


async function addToCart(trackId) {
    let response = await fetch(`../api/cart/add/${trackId}`);
    if (response.ok) {
        await updateCartPill();
        return true;
    }
    return false;
}

async function removeFromCart(trackId) {
    let response = await fetch(`../api/cart/remove/${trackId}`);
    if (response.ok) {
        await updateCartPill();
        return true;
    }
    return false;
}

async function clearCart() {
    let response = await fetch(`../api/cart/clear`);
    if (response.ok) {
        await updateCartPill();
        return true;
    }
    return false;
}

async function updateCartPill() {

    const cartPill = document.getElementById("cartPill");

    let response = await fetch(`../api/cart`)
        .then(response => response.json());

    cartTracks = response;
    let count = response.length;

    if (count == 0) {
        cartPill.hidden = true;
    }
    else {
        cartPill.innerText = count;
        cartPill.hidden = false;
    }

    // unhide the cart navlink 
    document.getElementById("cartNavLink").hidden = false;
}