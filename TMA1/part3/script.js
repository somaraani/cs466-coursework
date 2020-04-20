var images = [{
    path: "img1.jpg",
    caption: "Buildings in New York"
},
{
    path: "img2.jpg",
    caption: "A cemetary in Hamilton, Ontario"
},
{
    path: "img3.jpg",
    caption: "An Easton hockey stick"
},
{
    path: "img4.jpg",
    caption: "A beach in Vancouver"
},
{
    path: "img5.jpg",
    caption: "Park near my house"
},
{
    path: "img6.jpg",
    caption: "A building in New York"
},
{
    path: "img7.jpg",
    caption: "Downtown Toronto"
},
{
    path: "img8.jpg",
    caption: "A university in New York"
},
{
    path: "img9.jpg",
    caption: "A house with colored lamps"
},
{
    path: "img10.jpg",
    caption: "A big rock in Vancouver"
},
{
    path: "img11.jpg",
    caption: "My dog casper"
},
{
    path: "img12.jpg",
    caption: "Toronto lakeshore"
},
{
    path: "img13.jpg",
    caption: "Pianos in my university residence"
},
{
    path: "img14.jpg",
    caption: "Fields with white fence"
},
{
    path: "img15.jpg",
    caption: "Computer setup"
},
{
    path: "img16.jpg",
    caption: "Playground near my house"
},
{
    path: "img17.jpg",
    caption: "Two darts hit at the same exact spot"
},
{
    path: "img18.jpg",
    caption: "Lamp near my house"
},
{
    path: "img19.jpg",
    caption: "Trails in Hamilton"
},
{
    path: "img20.jpg",
    caption: "A TTC Bus"
}
];

const TIMEOUT = 3000;
var slideIndex = -1;

var random = false;
var running = true;

var transition = 0;
var forward = true;

var cancelled = false;

function displaySlide(manual, index) {
    if (!manual) {
        setTimeout(() => {
            displaySlide(false)
        }, TIMEOUT);


        if (!running) {
            return;
        }

        if (cancelled) {
            cancelled = false;
            return;
        }
    }

    if (manual) {
        cancelled = true;
    }

    if (index != undefined) {
        slideIndex = index;
    } else if (random) {
        slideIndex = Math.floor(Math.random() * (images.length));
    } else if (forward) {
        slideIndex++;
    } else {
        slideIndex--;
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

    var transitions = document.getElementById("transition");
    transition = transitions.options[transitions.selectedIndex].value;

    imageObject.onload = function () {

        if (transition == 1) {
            fadeIn(canvas, imageObject);
        } else if (transition == 2) {
            slideIn(canvas, imageObject);
        } else if (transition == 3) {
            slideTop(canvas, imageObject);
        } else {
            canvas.drawImage(imageObject, 0, 0, 800, 600);
        }

        document.getElementById("caption").innerText = (slideIndex + 1) + ". " + images[slideIndex].caption;
    }
}

function next() {
    displaySlide(true, slideIndex + 1);
}

function back() {
    displaySlide(true, slideIndex - 1);
}


function fadeIn(canvas, imageObject) {
    var alpha = 0;
    (function animation() {
        alpha += 0.002;

        canvas.globalAlpha = alpha;
        canvas.drawImage(imageObject, 0, 0, 800, 600);

        if (alpha < 0.5) {
            requestAnimationFrame(animation);
        } else {
            canvas.globalAlpha = 1;
        }
    })();
}

function slideIn(canvas, imageObject) {
    var x = 800;
    (function animation() {
        x -= 10;

        canvas.drawImage(imageObject, x, 0, 800, 600);

        if (x > 0) {
            requestAnimationFrame(animation);
        }
    })();
}

function slideTop(canvas, imageObject) {
    var h = 0;
    (function animation() {
        h += 5;

        canvas.drawImage(imageObject, 0, 0, 800, h);

        if (h < 600) {
            requestAnimationFrame(animation);
        }
    })();
}


function toggleMode() {
    random = !random;
    updateStatus();

    if (random) {
        slideIndex = Math.floor(Math.random() * (images.length));
        document.getElementById("orderToggle").innerText = "Toggle Sequential";
        document.getElementById("forward").disabled = true;
        document.getElementById("backward").disabled = true;
        document.getElementById("directionToggle").disabled = true;
    } else {
        document.getElementById("orderToggle").innerText = "Toggle Random";
        document.getElementById("directionToggle").disabled = false;
        document.getElementById("forward").disabled = false;
        document.getElementById("backward").disabled = false;
    }

}

function toggleDirection() {
    forward = !forward;
    updateStatus();

    if (forward) {
        document.getElementById("directionToggle").innerText = "Toggle Backwards";
    } else {
        document.getElementById("directionToggle").innerText = "Toggle Forwards";
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

    if (!random) {
        order += "(" + (forward ? "forward" : "backward") + ")";
    }

    const status = running ? "Running" : "Stopped";

    document.getElementById('status').innerHTML = `<p>Order = <span>${order}</span> &emsp; Status = <span>${status}</span></p>`
}

window.onload = function () {
    updateStatus();
    displaySlide();
}