
function hideOverlay() {
    document.getElementById("dimmer").hidden = true;
    document.getElementById("overlay").hidden = true;   
}

function showOverlay() {
    document.getElementById("dimmer").hidden = false;
    document.getElementById("overlay").hidden = false;   
}

function create() {
    showOverlay();
}

window.addEventListener("load", hideOverlay, false);
