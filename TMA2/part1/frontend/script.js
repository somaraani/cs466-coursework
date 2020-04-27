var editing = -1;

function hideOverlay() {
    document.getElementById("name").value = "";
    document.getElementById("url").value = "";  
    document.getElementById("dimmer").hidden = true;
    document.getElementById("overlay").hidden = true;
    editing = -1;
    document.getElementById("edit-id").value = editing;
    resize();
}

function showOverlay() {
    document.getElementById("dimmer").hidden = false;
    document.getElementById("overlay").hidden = false;   
}

function add() {
    showOverlay();
    editing = -1;
    document.getElementById("edit-id").value = editing;
}

function edit(id, name, url) {
    showOverlay();
    editing = id;
    document.getElementById("name").value = name;
    document.getElementById("url").value = "http://www." + url;
    document.getElementById("edit-id").value = editing;
}

function resize(){
    var containers = document.getElementsByClassName("bookmark");
    for(var i=0;i<containers.length;i++) {
        console.log(containers[i].offsetWidth);
        if(containers[i].offsetWidth > 390) {
            containers[i].style.width = "790px";
        }
    }
}

window.onresize = resize;
window.addEventListener("load", hideOverlay, false);
