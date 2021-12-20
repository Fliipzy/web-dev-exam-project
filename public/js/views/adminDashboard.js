let currentView = "Tracks";

// table constants & variables
const ROWS_PER_PAGE = 20;
let current_page_tracks = 0;
let current_page_albums = 0;
let current_page_artists = 0;
let current_page_customers = 0;
let current_page_invoices = 0;


// collections 
let tracks = [];
let albums = [];
let artists = [];
let customers = [];
let invoices = [];

// WHEN PAGE LOADS 

const dashboardListItems = document.querySelectorAll("#dashboardPanel nav ul li");

dashboardListItems.forEach(listItem => {
    listItem.addEventListener("click", () => {
        
        // remove .active from all list items
        dashboardListItems.forEach(listItem => {
            listItem.classList.remove("active");
        });
        
        // set .active for clicked list item
        listItem.classList.add("active");
        
        // change dashboard view
        changeDashboardView(listItem.getAttribute("view"));
    });
});

fetchTracks()
.then(() => {
    updateTracksTable();
});


// GENERAL FUNCTIONS

function changeDashboardView(view) {
    // first, hide all sections in dashboard view
    document.querySelectorAll("#dashboardView section").forEach(section => {
        section.hidden = true;
    });

    // then, unhide the wanted section
    switch (view) {
        case "Tracks":
            document.getElementById("tracksView").hidden = false;
            currentView = "Tracks";
            break;
        case "Albums":
            document.getElementById("albumsView").hidden = false;
            currentView = "Albums";
            break;
        case "Artists":
            document.getElementById("artistsView").hidden = false;
            currentView = "Artists";
            break;
        case "Customers":
            document.getElementById("customersView").hidden = false;
            currentView = "Customers";
            break;
        case "Invoices":
            document.getElementById("invoicesView").hidden = false;
            currentView = "Invoices";
            break;
    } 
}

// UPDATE TABLE FUNCTIONS

function updateTracksTable() {
    // get table elements
    let tracksTable = document.getElementById("tracksTable");
    let tracksTableTBody = document.getElementById("tracksTable").querySelector("tbody");

    if (tracks.length > 0) {
        for (let i = current_page_tracks * ROWS_PER_PAGE; i < (current_page_tracks + 1) * ROWS_PER_PAGE; i++) {
            // create new row element
            let row = document.createElement("tr");

            if (i < tracks.length) {
                // display empty rows
                row.innerHTML = 
                    `<td class="td-center">${tracks[i].TrackId}</td>
                     <td>${tracks[i].Name}</td>
                     <td>${tracks[i].Composer ?? ""}</td>
                     <td>${tracks[i].Album ?? ""}</td>
                     <td class="td-center">$ ${tracks[i].UnitPrice}</td>
                     <td class="td-center">
                        <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                     </td>`
            }
            else {
                // create empty row
                row.classList.add("empty");
                row.innerHTML = 
                    `<td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>`
            }
            // append the newly created row
            tracksTableTBody.append(row);
        }
    }
    else {
        
    }
}

function updateAlbumsTable() {
    let albumsTable = document.getElementById("albumsTable");
}

function updateArtistsTable() {
    let artistsTable = document.getElementById("artistsTable");
}

function updateCustomersTable() {
    let customersTable = document.getElementById("customersTable");
}

function updateInvoicesTable() {
    let invoicesTable = document.getElementById("invoicesTable");
}

// FETCH FUNCTIONS

function fetchTracks() {
    return fetch("../api/tracks/search", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ searchTerm: " ", genreId: 0 })
    })
    .then((response) => response.json())
    .then((tracksJson) => {
        tracks = tracksJson;
    });
}

function fetchAlbums() {
    fetch("../api/albums")
    .then((response) => response.json())
    .then((albumsJson) => {
        albums = albumsJson;
    });
}

function fetchArtists() {
    fetch("../api/artists")
    .then((response) => response.json())
    .then((artistsJson) => {
        artists = artistsJson;
    });
}

function fetchCustomers() {
    fetch("../api/customers")
    .then((response) => response.json())
    .then((customersJson) => {
        customers = customersJson;
    });
}

function fetchInvoices() {
    fetch("../api/invoices")
    .then((response) => response.json())
    .then((invoicesJson) => {
        invoices = invoicesJson;
    });
}