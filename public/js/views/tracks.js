document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault();

    document.getElementById("errorMessage").hidden = true;
    document.getElementById("searchResults").hidden = true;

    let formData = new FormData(document.getElementById("searchForm"));
    lastSearchQuery = sanitizeString(formData.get("query"));

    requestTrackData(lastSearchQuery);
});

document.getElementById("prev").addEventListener("click", function() {
    currentResultPage--;
    populateTrackTable();
});

document.getElementById("next").addEventListener("click", function() {
    currentResultPage++;
    populateTrackTable();
});

const TRACK_RESULTS_PER_PAGE = 15;
let currentResultPage = 0;
let lastSearchQuery;
let trackTable = document.getElementById("trackTable"); 
let tracks = [];

// start requesting the track data as soon as the script loads
requestTrackData();

function requestTrackData(searchQuery = null) {
    
    let xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        if (this.status == 200) {
            currentResultPage = 0;
            tracks = JSON.parse(this.response);
            populateTrackTable();

            // display search results
            if (searchQuery) {
                displaySearchResults();
            }
        }  
    };
    
    xhttp.open("GET", `../api/tracks?${searchQuery ? 'search=' + searchQuery : ''}`, true);
    xhttp.send();
}

function populateTrackTable() {

    if (tracks.length > 0) {
        //Unhide elements
        trackTable.hidden = false;
        document.getElementById("tablePagination").hidden = false;

        refreshPagination();

        let trackTableBody = trackTable.getElementsByTagName("tbody")[0];
        
        //remove already displayed tracks
        trackTableBody.innerHTML = "";
    
        for (let i = currentResultPage * TRACK_RESULTS_PER_PAGE; i < (currentResultPage + 1) * TRACK_RESULTS_PER_PAGE; i++) {
            
            if (i < tracks.length) {
                let row = document.createElement("tr");
                row.innerHTML = 
                    `<td>${tracks[i].Name}</td>` + 
                    `<td>${tracks[i].Composer ? tracks[i].Composer : ""}</td>` + 
                    `<td>${tracks[i].UnitPrice} <span class="minimizable-text">$</span></td>`;
                row.onclick = function() { openModal(i); }
                trackTableBody.append(row);
            }
            else {
                break;
            }
        }
    }
    else {
        let errorMessage = document.getElementById("errorMessage");
        errorMessage.innerHTML = `<br> Could not find any tracks for '${lastSearchQuery}'.`;

        //Hide & unhide necessary elements
        trackTable.hidden = true;
        document.getElementById("tablePagination").hidden = true;
        errorMessage.hidden = false;
    }
}

function displaySearchResults() {
    const searchResults = document.getElementById("searchResults");
    searchResults.innerHTML = 
        `<b>Search term:</b> ${lastSearchQuery}<br>` +
        `<b>Results found:</b> ${tracks.length}`;
    searchResults.hidden = false;
}

function refreshPagination() {

    const paginationSection = document.getElementById("tablePagination");
    const next = document.getElementById("next");
    const prev = document.getElementById("prev");

    //Update buttons

    if (currentResultPage == 0) {
        prev.setAttribute("disabled", true);
    }
    else {
        prev.removeAttribute("disabled");
    }

    if (currentResultPage == Math.ceil(tracks.length / TRACK_RESULTS_PER_PAGE) - 1) {
        next.setAttribute("disabled", true);
    }
    else {
        next.removeAttribute("disabled");
    }

    //Update span text
    paginationSection.getElementsByTagName("span")[0].innerHTML = 
        `&nbsp;Page <b>${currentResultPage + 1}</b> of ${Math.ceil(tracks.length / TRACK_RESULTS_PER_PAGE)}&nbsp;`
}

// track modal

const trackModal = document.getElementById("trackInfoModal");

// if user clicks close button, close modal
trackModal.getElementsByClassName("close")[0].addEventListener("click", function() {
    trackModal.hidden = true;
});

// if user clicks outside modal content, close modal
window.addEventListener("click", function(event) {
    if (event.target == trackModal) {
        trackModal.hidden = true;
    }
});

// open the modal and display the track info
async function openModal(trackId) {
    let album = await getAlbumInfo(tracks[trackId].AlbumId);
    let mediaType = await getMediaTypeInfo(tracks[trackId].MediaTypeId);
    let genre = await getGenreInfo(tracks[trackId].GenreId);

    let trackInfoElement = document.getElementById("trackInfo");
    trackInfoElement.innerHTML = "";
    trackInfoElement.innerHTML = 
        `<h2>${tracks[trackId].Name}</h2>` + 
        `<p><b>Composer:</b> ${tracks[trackId].Composer ? tracks[trackId].Composer : ''}</p>` + 
        `<p><b>Album:</b> ${album.Title}</p>` +
        `<p><b>Genre:</b> ${genre.Name}</p>` + 
        `<p><b>Media type:</b> ${mediaType.Name}</p>` + 
        `<p><b>Length:</b> ${getFormattedLength(tracks[trackId].Milliseconds)} minutes</p>` +
        `<p><b>Megabytes (MB):</b> ${tracks[trackId].Bytes / 1000000}</p>` +
        `<p><b>Price:</b> ${tracks[trackId].UnitPrice} $</p>` + 
        `<button class="btn btn-success" onclick="addToCart(${tracks[trackId].TrackId})">Add to cart</button>`;

    // open modal
    trackModal.hidden = false;
}

// fetch album data from api
async function getAlbumInfo(albumId) {
    return await fetch(`../api/albums/${albumId}`)
        .then(response => response.json());
}

// fetch mediatype data from api
async function getMediaTypeInfo(mediaTypeId) {
    return await fetch(`../api/mediatypes/${mediaTypeId}`)
        .then(response => response.json());
}

// fetch genre data from api
async function getGenreInfo(genreId) {
    return await fetch(`../api/genres/${genreId}`)
    .then(response => response.json());
}

function getFormattedLength(milliseconds) {
    let minutes = Math.floor(milliseconds / 60000);
    let seconds = ((milliseconds % 60000) / 1000).toFixed(0);

    return `${minutes}:${(seconds < 10 ? "0" : "")}${seconds}`;
}

async function addToCart(trackId) {

        await fetch(`../api/cart/add/${trackId}`);
        
        let response = await fetch(`../api/cart`)
            .then(response => response.json());
        
        let cartTracks = response;

        const cartPill = document.getElementById("cartPill");
        
        if (cartTracks.length == 0) {
            cartPill.hidden = true;
        }
        else {
            cartPill.innerText = cartTracks.length;;
            cartPill.hidden = false;
        }
        
        // unhide the cart navlink 
        document.getElementById("cartNavLink").hidden = false;

        // pop toast
        createToast("Info", "New track has been added to cart!", "success", "toastContainer");
}

