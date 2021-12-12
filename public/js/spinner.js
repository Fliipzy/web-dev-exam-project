function toggleSpinner(id) {
    document.getElementById(id).hidden = !document.getElementById(id).hidden;
}

function startSpinner(id) {
    document.getElementById(id).hidden = false;
}

function stopSpinner(id) {
    document.getElementById(id).hidden = true;
}