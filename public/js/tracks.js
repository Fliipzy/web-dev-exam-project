let trackTable = document.getElementById("trackTable"); 
let tracks = [];

// start requesting the track data as soon as the script loads
requestTrackData();

function requestTrackData() {

    let xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        if (this.status == 200) {
            tracks = JSON.parse(this.response);
            populateTrackTable();
        }  
    };

    xhttp.open("GET", "../api/tracks?limit=10", true);
    xhttp.send();
}

function populateTrackTable() {
    let trackTableBody = trackTable.getElementsByTagName("tbody")[0];

    tracks.forEach(track => {
        let row = document.createElement("tr");
        row.innerHTML = `<td>${track.Name}</td> <td>${track.Composer ? track.Composer : "Unknown artist"}</td> <td>${track.UnitPrice} $</td>`;
        trackTableBody.append(row);
    });

}