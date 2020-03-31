var images = [{
    path: "img1.jpg",
    caption: "The first caption"
},
{
    path: "img2.jpeg",
    caption: "The second caption"
}];

const TIMEOUT = 3000;
var slideIndex = 0;

var random = false;
var running = true;
var forward = true;

function displaySlide() {
    setTimeout(() => {
        displaySlide()
    }, TIMEOUT);

    if (!running) {
        return;
    }

    if (slideIndex >= images.length) {
        slideIndex = 0;
    }

    if (slideIndex < 0) {
        slideIndex = images.length - 1;
    }

    const canvas = document.getElementById('slideshow').getContext('2d');

    const imageObject = new Image();
    imageObject.src = "imgs/" + images[slideIndex].path;
    imageObject.onload = function () {
        canvas.drawImage(imageObject, 0, 0);
        document.getElementById("caption").innerText = (slideIndex + 1) + ". " + images[slideIndex].caption;

        if (random) {
            slideIndex = Math.floor(Math.random() * (images.length));
        } else if(forward){
            slideIndex++;
        } else {
            slideIndex--;
        }
    }
}

function toggleMode() {
    random = !random;
    updateStatus();

    if (random) {
        slideIndex = Math.floor(Math.random() * (images.length));
        document.getElementById("orderToggle").innerText = "Toggle Sequential";
        document.getElementById("directionToggle").disabled = true;
    } else {
        document.getElementById("directionToggle").disabled = false;
        document.getElementById("orderToggle").innerText = "Toggle Random";
    }

}

function toggleStatus() {
    running = !running;
    updateStatus();

    if (running) {
        document.getElementById("statusToggle").innerText = "Stop Slideshow";
    } else {
        document.getElementById("statusToggle").innerText = "Start Slideshow";
    }
}

function updateStatus() {
    var order = random ? "Random" : "Sequential";
    
    if(!random) {
        order += "(" + (forward ? "forward" : "backward") + ")";
    }

    const status = running ? "Running" : "Stopped";

    document.getElementById('status').innerHTML = `<p>Order = <span>${order}</span> &emsp; Status = <span>${status}</span></p>`
}

function toggleDirection() {
    forward = !forward;
    updateStatus();

    if(forward) {
        document.getElementById("directionToggle").innerText = "Toggle Backwards";
    } else {
        document.getElementById("directionToggle").innerText = "Toggle Forwards";
    }
}


window.onload = function () {
    updateStatus();
    displaySlide();
}