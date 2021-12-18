const table = document.getElementById("cartTable");
const tbody = table.querySelector("tbody");

const ITEMS_PER_PAGE = 10;
let currentPage = 0;
let tracks = [];

// start by fetching cart tracks when the page executes this script
fetchCartTracks();

function fetchCartTracks() {
    // first fetch all cart track id's
    fetch("../api/cart")
    .then((response) => response.json())
    .then((trackIds) => {
        // now that we have the track id's, fetch each track individually
        let promises = [];
        for (let i = 0; i < trackIds.length; i++) {
            promises.push(fetch("../api/tracks/" + trackIds[i]));
        }
        // Wait for all response promises to finish, then wait for all json data promises
        Promise.all(promises)
        .then((responses) => Promise.all(responses.map(r => r.json())))
        .then((tracks) => {
            // now assign this.tracks to the fetched tracks
            // then aggregate identical tracks and add amount property
            // lastly, update the cart track to render the table
            aggregateTracks(tracks);
            updateCartTable();
        });
    });
}

function aggregateTracks(tracks) {
    let aggregated = [];
    tracks.forEach(track => {
        // if aggregated array already has the track, increment 'Amount' property
        if (aggregated.some(t => t.TrackId == track.TrackId)) {
            let index = aggregated.findIndex(t => t.TrackId == track.TrackId);
            aggregated[index].Amount += 1;
            aggregated[index].UnitPrice = (+aggregated[index].UnitPrice + +track.UnitPrice).toFixed(2);
        }
        // else push the track to aggregated array
        else {
            track.Amount = 1;
            aggregated.push(track);
        }
    });
    this.tracks = aggregated;
}

function updateCartTable() {
    // first remove all previous rendered rows in tbody
    tbody.innerHTML = "";

    if (this.tracks.length > 0) {
        // iterate over tracks and incrementally add the rows to the tbody
        for (let i = currentPage * ITEMS_PER_PAGE; i < (currentPage + 1) * ITEMS_PER_PAGE; i++) {

            if (i < this.tracks.length) {
                // create row elements
                let row = document.createElement("tr");
                let tdTitle = document.createElement("td");
                let tdAmount = document.createElement("td");
                let tdPrice = document.createElement("td");
                let tdRemoveBtn = document.createElement("td");
    
                tdTitle.textContent = this.tracks[i].Name;
                tdAmount.textContent = this.tracks[i].Amount;
                tdPrice.textContent = this.tracks[i].UnitPrice;
                tdRemoveBtn.innerHTML = `<button class='btn btn-sm' onclick='removeCartTrack(${this.tracks[i].TrackId})'><i class='fas fa-times'></i></button>`;
    
                // assemble row elements in order
                row.appendChild(tdTitle);
                row.appendChild(tdAmount);
                row.appendChild(tdPrice);
                row.appendChild(tdRemoveBtn);
                tbody.appendChild(row);
            }
            else {
                break;
            }
        }
    }
    else {
        // hide table section & display empty cart section
        table.hidden = true;
    }
}

function removeCartTrack(id) {
    fetch("../api/cart/remove/" + id)
    .then(() => {
        // update whole table by invoking 'fetchCartTracks'
        // not the smartest approach but very easy
        fetchCartTracks();

        //update cart pill in navbar
        let tracksInCart = 0;
        for (let i = 0; i < this.tracks.length; i++) {
            tracksInCart += this.tracks[i].Amount;
        }
        if (tracksInCart - 1 > 0) {
            document.getElementById("cartPill").textContent = (tracksInCart - 1);
        }
        else {
            // hide the pill & display the 'empty cart' section
            document.getElementById("cartPill").hidden = true;
            document.getElementById("cartSection").hidden = true;
            document.getElementById("emptyCartSection").hidden = false;
        }

        // pop toast
        createToast("Info", "Track was removed from cart!", "primary", "toastContainer");
    });
}

function goToCheckout() {
    window.location.replace("/webexam/views/checkout.php");
}