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

// fetch all table data
fetchTracks();
fetchAlbums();
fetchArtists();
fetchCustomers();
fetchInvoices();

//////////////////////////////              WHEN PAGE LOADS           //////////////////////////////// 

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

////////////////////////////////////////    EVENTS    ///////////////////////////////////////////

window.addEventListener("click", function (event) {

    if (event.target == document.getElementById("tracksUpdateModal")) {
        document.getElementById("tracksUpdateModal").hidden = true;
    }
    else if (event.target == document.getElementById("tracksDeleteModal")) {
        document.getElementById("tracksDeleteModal").hidden = true;
    }
    else if (event.target == document.getElementById("tracksCreateModal")) {
        document.getElementById("tracksCreateModal").hidden = true;
    }

    else if (event.target == document.getElementById("albumsUpdateModal")) {
        document.getElementById("albumsUpdateModal").hidden = true;
    }
    else if (event.target == document.getElementById("albumsDeleteModal")) {
        document.getElementById("albumsDeleteModal").hidden = true;
    }
    else if (event.target == document.getElementById("albumsCreateModal")) {
        document.getElementById("albumsCreateModal").hidden = true;
    }

    else if (event.target == document.getElementById("artistsUpdateModal")) {
        document.getElementById("artistsUpdateModal").hidden = true;
    }
    else if (event.target == document.getElementById("artistsDeleteModal")) {
        document.getElementById("artistsDeleteModal").hidden = true;
    }
    else if (event.target == document.getElementById("artistsCreateModal")) {
        document.getElementById("artistsCreateModal").hidden = true;
    }

    else if (event.target == document.getElementById("customersViewModal")) {
        document.getElementById("customersViewModal").hidden = true;
    }

    else if (event.target == document.getElementById("invoicesViewModal")) {
        document.getElementById("invoicesViewModal").hidden = true;
    }
});

////////////////////////////////////////    MODAL FUNCTIONS & EVENTS      ///////////////////////////////////

function openTracksUpdateModal(track) {
    // get modal elements
    let tracksUpdateModal = document.getElementById("tracksUpdateModal");
    let trackUpdateForm = tracksUpdateModal.querySelector("form");

    tracksUpdateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        tracksUpdateModal.hidden = true;
    }, {once: true});

    // set form input values
    trackUpdateForm.querySelector("input[name='id']").value = track.TrackId;
    trackUpdateForm.querySelector("input[name='title']").value = track.Name;
    trackUpdateForm.querySelector("input[name='album']").value = track.Album;
    trackUpdateForm.querySelector("input[name='artist']").value = track.Artist;
    trackUpdateForm.querySelector("select[name='mediaTypeId']").value = track.MediaTypeId;
    trackUpdateForm.querySelector("select[name='genreId']").value = track.GenreId;
    trackUpdateForm.querySelector("input[name='composer']").value = track.Composer;
    trackUpdateForm.querySelector("input[name='milliseconds']").value = track.Milliseconds;
    trackUpdateForm.querySelector("input[name='bytes']").value = track.Bytes;
    trackUpdateForm.querySelector("input[name='unitPrice']").value = track.UnitPrice;

    // event listener for form submit
    trackUpdateForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let formData = new FormData(trackUpdateForm);

        fetch("../api/tracks", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                trackId: formData.get("id"),
                name: formData.get("title"),
                album: formData.get("album"),
                artist: formData.get("artist"),
                mediaTypeId: trackUpdateForm.querySelector("select[name='mediaTypeId']").value,
                genreId: trackUpdateForm.querySelector("select[name='genreId']").value,
                composer: formData.get("composer"),
                milliseconds: formData.get("milliseconds"),
                bytes: formData.get("bytes"),
                unitPrice: formData.get("unitPrice")
            })
        })
            .then((response) => {
                createToast("Info", "Track was succcesfully updated!", "success", "toastContainer");
                fetchTracks();
                tracksUpdateModal.hidden = true;
            })
            .catch((error) => {
                createToast("Info", "Track could not be updated!", "danger", "toastContainer");
                tracksUpdateModal.hidden = true;
            });
    }, {once: true});

    // finally show the modal
    tracksUpdateModal.hidden = false;
}

function openTracksDeleteModal(trackId) {
    let tracksDeleteModal = document.getElementById("tracksDeleteModal");

    tracksDeleteModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        tracksDeleteModal.hidden = true;
    }, {once: true});

    document.getElementById("tracksDeleteModal").querySelector("button").addEventListener("click", () => {
        fetch("../api/tracks/" + trackId, {
            method: "DELETE"
        })
            .then((response) => {
                createToast("Info", "Track was succcesfully deleted!", "success", "toastContainer");
                fetchTracks();
                tracksDeleteModal.hidden = true;
            });
    }, {once: true});

    tracksDeleteModal.hidden = false;
}

function openTracksCreateModal() {
    let tracksCreateModal = document.getElementById("tracksCreateModal");
    let tracksCreateModalForm = tracksCreateModal.querySelector("form");

    tracksCreateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        tracksCreateModal.hidden = true;
    }, {once: true});

    tracksCreateModalForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let formData = new FormData(tracksCreateModalForm);

        fetch("../api/tracks", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                name: formData.get("title"),
                album: formData.get("album"),
                artist: formData.get("artist"),
                mediaTypeId: tracksCreateModalForm.querySelector("select[name='mediaTypeId']").value,
                genreId: tracksCreateModalForm.querySelector("select[name='genreId']").value,
                composer: formData.get("composer"),
                milliseconds: formData.get("milliseconds"),
                bytes: formData.get("bytes"),
                unitPrice: formData.get("unitPrice")
            })
        })
            .then((response) => {
                createToast("Info", "Track was succcesfully created!", "success", "toastContainer");
                fetchTracks();
                tracksCreateModal.hidden = true;
            })
            .catch((error) => {
                createToast("Info", "Track could not be created!", "danger", "toastContainer");
                tracksCreateModal.hidden = true;
            });
    }, {once: true});

    tracksCreateModal.hidden = false;
}

function openAlbumsUpdateModal(album) {
    let albumsUpdateModal = document.getElementById("albumsUpdateModal");
    let albumUpdateForm = albumsUpdateModal.querySelector("form");

    albumsUpdateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        albumsUpdateModal.hidden = true;
    }, {once: true});

    albumUpdateForm.querySelector("input[name='id']").value = album.AlbumId;
    albumUpdateForm.querySelector("input[name='title']").value = album.Title;
    albumUpdateForm.querySelector("input[name='artist']").value = album.Artist;

    albumUpdateForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(albumUpdateForm);

        fetch("../api/albums", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                albumId: formData.get("id"),
                title: formData.get("title"),
                artist: formData.get("artist")
            })
        })
        .then((response) => {
            if (response.ok) {
                createToast("Info", "Album was succcesfully updated!", "success", "toastContainer");
                fetchAlbums();
                albumsUpdateModal.hidden = true;
            }
            else {
                createToast("Error", "Album could not be updated!", "danger", "toastContainer");
                albumsUpdateModal.hidden = true;
            }
        })
        .catch((error) => {
            createToast("Error", "Album could not be updated!", "danger", "toastContainer");
            albumsUpdateModal.hidden = true;
        });
    }, {once: true});

    albumsUpdateModal.hidden = false;
}

function openAlbumsDeleteModal(albumId) {
    let albumsDeleteModal = document.getElementById("albumsDeleteModal");

    albumsDeleteModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        albumsDeleteModal.hidden = true;
    }, {once: true});

    document.getElementById("albumsDeleteModal").querySelector("button").addEventListener("click", () => {
        fetch("../api/albums/" + albumId, {
            method: "DELETE"
        })
        .then((response) => {
            createToast("Info", "Track was succcesfully deleted!", "success", "toastContainer");
            fetchTracks();
            albumsDeleteModal.hidden = true;
        });
    }, {once: true});

    albumsDeleteModal.hidden = false;
}

function openAlbumsCreateModal() {
    let albumsCreateModal = document.getElementById("albumsCreateModal");
    let albumsCreateModalForm = albumsCreateModal.querySelector("form");

    albumsCreateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        albumsCreateModal.hidden = true;
    }, {once: true});

    albumsCreateModalForm.querySelector("input[name='id']").value = album.AlbumId;
    albumsCreateModalForm.querySelector("input[name='title']").value = album.Title;
    albumsCreateModalForm.querySelector("input[name='artist']").value = album.Artist;

    albumsCreateModalForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(albumsCreateModalForm);

        fetch("../api/albums", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                title: formData.get("title"),
                artist: formData.get("artist")
            })
        })
        .then((response) => {
            if (response.ok) {
                createToast("Info", "Album was succcesfully updated!", "success", "toastContainer");
                fetchAlbums();
                albumsCreateModal.hidden = true;
            }
            else {
                createToast("Error", "Album could not be updated!", "danger", "toastContainer");
                albumsCreateModal.hidden = true;
            }
        })
        .catch((error) => {
            createToast("Error", "Album could not be updated!", "danger", "toastContainer");
            albumsCreateModal.hidden = true;
        });
    }, {once: true});

    albumsCreateModal.hidden = false;
}

function openArtistsUpdateModal(artist) {
    let artistsUpdateModal = document.getElementById("artistsUpdateModal");
    let artistsUpdateModalForm = artistsUpdateModal.querySelector("form");
    
    artistsUpdateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        artistsUpdateModal.hidden = true;
    }, {once: true});

    artistsUpdateModalForm.querySelector("input[name='id']").value = artist.ArtistId;
    artistsUpdateModalForm.querySelector("input[name='name']").value = artist.Name;

    artistsUpdateModalForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(artistsUpdateModalForm);

        fetch("../api/artists", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ 
                artistId: formData.get("id"),
                name: formData.get("name") 
            })
        })
        .then((response) => {
            if (response.ok) {
                createToast("Info", "Artist was succcesfully updated!", "success", "toastContainer");
                fetchArtists();
                artistsUpdateModal.hidden = true;
            }
            else {
                createToast("Info", "Artist could not be updated!", "danger", "toastContainer");
                artistsUpdateModal.hidden = true;
            }
        });
    }, {once: true});

    artistsUpdateModal.hidden = false;
}

function openArtistsDeleteModal(artistId) {
    let artistsDeleteModal = document.getElementById("artistsDeleteModal");
    
    artistsDeleteModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        artistsDeleteModal.hidden = true;
    }, {once: true});

    document.getElementById("artistsDeleteModal").querySelector("button").addEventListener("click", () => {
        fetch("../api/artists" + artistId, {
            method: "DELETE"
        })
        .then(() => {
            createToast("Info", "Artist was succcesfully deleted!", "success", "toastContainer");
            fetchArtists();
            artistsDeleteModal.hidden = true;
        });
    }, {once: true} );

    artistsDeleteModal.hidden = false;
}

function openArtistsCreateModal() {
    let artistsCreateModal = document.getElementById("artistsCreateModal");
    let artistsCreateModalForm = artistsCreateModal.querySelector("form");

    artistsCreateModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        artistsCreateModal.hidden = true;
    }, {once: true});

    artistsCreateModalForm.querySelector("input[name='id']").value = artist.ArtistId;
    artistsCreateModalForm.querySelector("input[name='name']").value = artist.Name;

    artistsCreateModalForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(artistsCreateModalForm);

        fetch("../api/artists", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ 
                name: formData.get("name") 
            })
        })
        .then((response) => {
            if (response.ok) {
                createToast("Info", "Artist was succcesfully updated!", "success", "toastContainer");
                fetchArtists();
                artistsCreateModal.hidden = true;
            }
            else {
                createToast("Info", "Artist could not be updated!", "danger", "toastContainer");
                artistsCreateModal.hidden = true;
            }
        });
    }, {once: true});

    artistsCreateModal.hidden = false;
}

function openCustomersViewModal(customer) {
    let customersViewModal = document.getElementById("customersViewModal");
    
    customersViewModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        customersViewModal.hidden = true;
    }, {once: true});

    customersViewModal.querySelector("input[name='firstName']").value = customer.FirstName;
    customersViewModal.querySelector("input[name='lastName']").value = customer.LastName;
    customersViewModal.querySelector("input[name='email']").value = customer.Email;
    customersViewModal.querySelector("input[name='phone']").value = customer.Phone;
    customersViewModal.querySelector("input[name='company']").value = customer.Company;
    customersViewModal.querySelector("input[name='fax']").value = customer.Fax;
    customersViewModal.querySelector("input[name='country']").value = customer.Country;
    customersViewModal.querySelector("input[name='state']").value = customer.State;
    customersViewModal.querySelector("input[name='city']").value = customer.City;
    customersViewModal.querySelector("input[name='postalCode']").value = customer.PostalCode;
    customersViewModal.querySelector("input[name='address']").value = customer.Address;
    
    customersViewModal.hidden = false;
}

function openInvoicesViewModal(invoice) {
    let invoicesViewModal = document.getElementById("invoicesViewModal");
    
    invoicesViewModal.getElementsByClassName("close")[0].addEventListener("click", function () {
        invoicesViewModal.hidden = true;
    }, {once: true});

    invoicesViewModal.querySelector("input[name='customer']").value = invoice.Customer;
    invoicesViewModal.querySelector("input[name='invoiceDate']").value = invoice.InvoiceDate;
    invoicesViewModal.querySelector("input[name='billingCity']").value = invoice.BillingCity;
    invoicesViewModal.querySelector("input[name='billingAddress']").value = invoice.BillingAddress;
    invoicesViewModal.querySelector("input[name='billingPostalCode']").value = invoice.BillingPostalCode;
    invoicesViewModal.querySelector("input[name='billingState']").value = invoice.BillingState;
    invoicesViewModal.querySelector("input[name='billingCountry']").value = invoice.BillingCountry;
    invoicesViewModal.querySelector("input[name='billingAddress']").value = invoice.BillingAddress;
    invoicesViewModal.querySelector("input[name='total']").value = invoice.Total;

    invoicesViewModal.hidden = false;
}

//////////////////////////////////////    PAGINATION UI EVENTS   ///////////////////////////////////

document.getElementById("next").addEventListener("click", () => {
    // increment the current page view
    switch (currentView) {
        case "Tracks":
            current_page_tracks++;
            updateTracksTable();
            break;
        case "Albums":
            current_page_albums++;
            updateAlbumsTable();
            break;
        case "Artists":
            current_page_artists++;
            updateArtistsTable();
            break;
        case "Customers":
            current_page_customers++;
            updateCustomersTable();
            break;
        case "Invoices":
            current_page_invoices++;
            updateInvoicesTable();
            break;
    }
    // update the pagination section elements
    updatePagination();
});

document.getElementById("prev").addEventListener("click", () => {
    // increment the current page view
    switch (currentView) {
        case "Tracks":
            current_page_tracks--;
            updateTracksTable();
            break;
        case "Albums":
            current_page_albums--;
            updateAlbumsTable();
            break;
        case "Artists":
            current_page_artists--;
            updateArtistsTable();
            break;
        case "Customers":
            current_page_customers--;
            updateCustomersTable();
            break;
        case "Invoices":
            current_page_invoices--;
            updateInvoicesTable();
            break;
    }
    // update the pagination section elements
    updatePagination();
});

//////////////////////////////////////    GENERAL FUNCTIONS          //////////////////////////////////////

function changeDashboardView(view) {
    // first, hide all sections in dashboard view
    document.querySelectorAll("#dashboardView section").forEach(section => {
        if (section.id != "tablePagination") {
            section.hidden = true;
        }
    });

    // then, unhide the wanted section
    switch (view) {
        case "Tracks":
            currentView = "Tracks";
            document.getElementById("tracksView").hidden = false;
            document.getElementById("createEntityButton").innerText = "Create new track";
            document.getElementById("createEntityButton").onclick = function() { openTracksCreateModal() }
            document.getElementById("createEntityButton").hidden = false;
            break;
        case "Albums":
            currentView = "Albums";
            document.getElementById("albumsView").hidden = false;
            document.getElementById("createEntityButton").innerText = "Create new album";
            document.getElementById("createEntityButton").onclick = function() { openAlbumsCreateModal() }
            document.getElementById("createEntityButton").hidden = false;
            break;
        case "Artists":
            currentView = "Artists";
            document.getElementById("artistsView").hidden = false;
            document.getElementById("createEntityButton").innerText = "Create new artist";
            document.getElementById("createEntityButton").onclick = function() { openArtistsCreateModal() }
            document.getElementById("createEntityButton").hidden = false;
            break;
        case "Customers":
            currentView = "Customers";
            document.getElementById("customersView").hidden = false;
            document.getElementById("createEntityButton").hidden = true;
            break;
        case "Invoices":
            currentView = "Invoices";
            document.getElementById("invoicesView").hidden = false;
            document.getElementById("createEntityButton").hidden = true;
            break;
    }
    updatePagination();
}

////////////////////////////////////      UPDATE TABLE FUNCTIONS     ////////////////////////////////////////

function updateTracksTable() {
    // get table elements
    let tracksTableTBody = document.getElementById("tracksTable").querySelector("tbody");

    // before we insert new rows, we need to clear the previous rows
    tracksTableTBody.innerHTML = "";

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
                        <button onclick="event.stopPropagation(); openTracksDeleteModal(${tracks[i].TrackId})" class="btn btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                     </td>`

                // open the update modal when user clicks the row
                row.onclick = function (e) { openTracksUpdateModal(tracks[i]) };
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
}

function updateAlbumsTable() {
    // get table elements
    let albumsTableTBody = document.getElementById("albumsTable").querySelector("tbody");

    // before we insert new rows, we need to clear the previous rows
    albumsTableTBody.innerHTML = "";

    if (albums.length > 0) {
        for (let i = current_page_albums * ROWS_PER_PAGE; i < (current_page_albums + 1) * ROWS_PER_PAGE; i++) {
            // create new row element
            let row = document.createElement("tr");

            if (i < albums.length) {
                // display empty rows
                row.innerHTML =
                    `<td class="td-center">${albums[i].AlbumId}</td>
                     <td>${albums[i].Title}</td>
                     <td>${albums[i].ArtistId}</td>
                     <td class="td-center">
                        <button onclick="event.stopPropagation(); openAlbumsDeleteModal(${albums[i].AlbumId})" class="btn btn-sm">
                        <i class="fas fa-trash"></i>
                        </button>
                     </td>`

                row.onclick = function () { openAlbumsUpdateModal(albums[i]) }
            }
            else {
                // create empty row
                row.classList.add("empty");
                row.innerHTML =
                    `<td></td>
                     <td></td>
                     <td></td>
                     <td></td>`
            }
            // append the newly created row
            albumsTableTBody.append(row);
        }
    }
}

function updateArtistsTable() {
    // get table elements
    let artistsTableTBody = document.getElementById("artistsTable").querySelector("tbody");

    // before we insert new rows, we need to clear the previous rows
    artistsTableTBody.innerHTML = "";

    if (artists.length > 0) {
        for (let i = current_page_artists * ROWS_PER_PAGE; i < (current_page_artists + 1) * ROWS_PER_PAGE; i++) {
            // create new row element
            let row = document.createElement("tr");

            if (i < artists.length) {
                // display empty rows
                row.innerHTML =
                    `<td class="td-center">${artists[i].ArtistId}</td>
                     <td>${artists[i].Name}</td>
                     <td class="td-center">
                        <button onclick="event.stopPropagation(); openArtistsDeleteModal(${artists[i].ArtistId})" class="btn btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                     </td>`

                row.onclick = function () { openArtistsUpdateModal(artists[i]) }
            }
            else {
                // create empty row
                row.classList.add("empty");
                row.innerHTML =
                    `<td></td>
                     <td></td>
                     <td></td>`
            }
            // append the newly created row
            artistsTableTBody.append(row);
        }
    }
}

function updateCustomersTable() {
    // get table elements
    let customersTableTBody = document.getElementById("customersTable").querySelector("tbody");

    // before we insert new rows, we need to clear the previous rows
    customersTableTBody.innerHTML = "";

    if (customers.length > 0) {
        for (let i = current_page_customers * ROWS_PER_PAGE; i < (current_page_customers + 1) * ROWS_PER_PAGE; i++) {
            // create new row element
            let row = document.createElement("tr");

            if (i < customers.length) {
                // display empty rows
                row.innerHTML =
                    `<td class="td-center">${customers[i].CustomerId}</td>
                     <td>${customers[i].FirstName}</td>
                     <td>${customers[i].LastName}</td>
                     <td>${customers[i].Email}</td>
                     <td>${customers[i].Address}</td>
                     <td>${customers[i].Country}</td>`

                row.onclick = function () { openCustomersViewModal(customers[i]) }
            }
            else {
                // create empty row
                row.classList.add("empty");
                row.innerHTML =
                    `<td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>`
            }
            // append the newly created row
            customersTableTBody.append(row);
        }
    }
}

function updateInvoicesTable() {
    // get table elements
    let invoicesTableTBody = document.getElementById("invoicesTable").querySelector("tbody");

    // before we insert new rows, we need to clear the previous rows
    invoicesTableTBody.innerHTML = "";

    if (invoices.length > 0) {
        for (let i = current_page_invoices * ROWS_PER_PAGE; i < (current_page_invoices + 1) * ROWS_PER_PAGE; i++) {
            // create new row element
            let row = document.createElement("tr");

            if (i < invoices.length) {
                // display empty rows
                row.innerHTML =
                    `<td class="td-center">${invoices[i].InvoiceId}</td>
                     <td>${invoices[i].CustomerId}</td>
                     <td>${invoices[i].InvoiceDate}</td>
                     <td>${invoices[i].BillingAddress}</td>
                     <td>${invoices[i].Total}</td>`

                row.onclick = function () { openInvoicesViewModal(invoices[i]) }
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
            invoicesTableTBody.append(row);
        }
    }
}

// UPDATE PAGINATION

function updatePagination() {

    let currentResultPage;
    let currentTableLength;

    switch (currentView) {
        case "Tracks":
            currentResultPage = current_page_tracks;
            currentTableLength = tracks.length;
            break;
        case "Albums":
            currentResultPage = current_page_albums;
            currentTableLength = albums.length;
            break;
        case "Artists":
            currentResultPage = current_page_artists;
            currentTableLength = artists.length;
            break;
        case "Customers":
            currentResultPage = current_page_customers;
            currentTableLength = customers.length;
            break;
        case "Invoices":
            currentResultPage = current_page_invoices;
            currentTableLength = invoices.length;
            break;
    }

    // if the current view table is on page 0, disable prev button
    if (currentResultPage == 0) {
        document.getElementById("prev").setAttribute("disabled", true);
    }
    else {
        document.getElementById("prev").removeAttribute("disabled");
    }

    // if the current view table is on the last page
    if (currentResultPage == Math.ceil(currentTableLength / ROWS_PER_PAGE) - 1) {
        document.getElementById("next").setAttribute("disabled", "true");
    }
    else {
        document.getElementById("next").removeAttribute("disabled");
    }

    // update span text between the two pagination buttons
    document.getElementById("tablePagination").querySelectorAll("span")[0].innerHTML =
        `&nbsp;Page <b>${currentResultPage + 1}</b> of ${Math.ceil(currentTableLength / ROWS_PER_PAGE)}&nbsp;`
}

// FETCH FUNCTIONS

function fetchTracks() {
    fetch("../api/tracks/search", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ searchTerm: " ", genreId: 0 })
    })
        .then((response) => response.json())
        .then((tracksJson) => {
            tracks = tracksJson;
            updateTracksTable();
            updatePagination();
        });
}

function fetchAlbums() {
    fetch("../api/albums")
        .then((response) => response.json())
        .then((albumsJson) => {
            albums = albumsJson;
            updateAlbumsTable();
            updatePagination();
        });
}

function fetchArtists() {
    fetch("../api/artists")
        .then((response) => response.json())
        .then((artistsJson) => {
            artists = artistsJson;
            updateArtistsTable();
            updatePagination();
        });
}

function fetchCustomers() {
    fetch("../api/customers")
        .then((response) => response.json())
        .then((customersJson) => {
            customers = customersJson;
            updateCustomersTable();
            updatePagination();
        });
}

function fetchInvoices() {
    fetch("../api/invoices")
        .then((response) => response.json())
        .then((invoicesJson) => {
            invoices = invoicesJson;
            updateInvoicesTable();
            updatePagination();
        });
}