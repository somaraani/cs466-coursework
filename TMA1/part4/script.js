var currentColor = "(255,0,0)"
var canvas;
var context;

function display(name) {
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', name + ".html", true);;
    httpRequest.onload = function () {
            var content = httpRequest.responseText;
            document.querySelector('#tool-content').innerHTML = content;

            if(name == 'color') {
                initCanvas();
            }
    };
    httpRequest.send();
}

function weightUpdate(type) {
    if(type == 'm') {
        removeNonNumeric('wm');
        document.getElementById('wi').value = (document.getElementById('wm').value * 2.205).toFixed(3);
    } else {
        //removeNonNumeric('wi');
        document.getElementById('wm').value = (document.getElementById('wi').value / 2.205).toFixed(3);
    }
}

function lengthUpdate(type) {

    if(type == 'm') {
        removeNonNumeric('lm');
        document.getElementById('li').value = (document.getElementById('lm').value * 3.281).toFixed(3);
    } else {
        removeNonNumeric('li');
        document.getElementById('lm').value = (document.getElementById('li').value / 3.281).toFixed(3);
    }
}

function areaUpdate(type) {
    if(type == 'm') {
        removeNonNumeric('am');
        document.getElementById('ai').value = (document.getElementById('am').value *  10.764).toFixed(3);
    } else {
        removeNonNumeric('ai');
        document.getElementById('am').value = (document.getElementById('ai').value / 10.764).toFixed(3);
    }
}

function volumeUpdate(type) {
    if(type == 'm') {
        removeNonNumeric('vm');
        document.getElementById('vi').value = (document.getElementById('vm').value *  35.315).toFixed(3);
    } else {
        removeNonNumeric('vi');
        document.getElementById('vm').value = (document.getElementById('vi').value /  35.315).toFixed(3);
    }
}

function calculateMortgage() {
    removeNonNumeric('amount');
    removeNonNumeric('interest')
    removeNonNumeric('period');

    const amount = document.getElementById("amount").value;
    const interest = document.getElementById("interest").value;
    const period = document.getElementById("period").value;

    if(amount != "" && interest != "" && period != "") {
        const i = interest/100/12;
        const n = period * 12;

        var d = (Math.pow(1 + i, n) - 1)/(i * Math.pow(1 + i, n));
        var p = amount/d;

        document.getElementById("payment").innerText = "$" + p.toFixed(3);
    }
}

function removeNonNumeric(id){
    var value = document.getElementById(id).value;
    document.getElementById(id).value = value.replace(/[^\d.]/g,'')

    if(value.split(".").length > 2 && value.charAt(value.length - 1) == '.') {
        document.getElementById(id).value = value.substr(0, value.length - 1);
    }
}

function initCanvas() {
    currentColor = "(255,0,0)";
    canvas = document.getElementById('canvas');
    context = canvas.getContext('2d');

    //get all RGB colors by doing gradient from r-g g-b b-r (and in between)
    var gr = context.createLinearGradient(0, 0, 800, 0);

    gr.addColorStop(0/6, "red");
    gr.addColorStop(1/6, "fuchsia");
    gr.addColorStop(2/6, "blue");
    gr.addColorStop(3/6, "aqua");
    gr.addColorStop(4/6, "lime");
    gr.addColorStop(5/6, "yellow");
    gr.addColorStop(6/6, "red");

    context.fillStyle = gr;
    context.fillRect(0,0, 800,600);

    gr = context.createLinearGradient(0,0,0,600);
    gr.addColorStop(0, "rgba(0,0,0,0)");
    gr.addColorStop(1, "white");

    context.fillStyle = gr;
    context.fillRect(0,0, 800,600);

    drawBottom();

    canvas.addEventListener("click", function(e) {
        const ypos = e.pageY - canvas.offsetTop;
        const xpos = e.pageX - canvas.offsetLeft;
        const imageData = context.getImageData(xpos, ypos, 1, 1).data;
        
        console.log(`${xpos}, ${ypos}`);
        currentColor =  `(${imageData[0]}, ${imageData[1]}, ${imageData[2]})`;

        document.getElementById("rgb").innerText = currentColor;


        var hex = "#";
        for(var i = 0; i < 3; i++) {
            const numInHex = parseInt(imageData[i]).toString(16);
            if(numInHex.length == 1) {
                hex += "0" + numInHex;
            } else {
                hex += numInHex;
            }
        }

        document.getElementById("hex").innerText = hex;
        document.getElementById("color").style.backgroundColor = hex;

        if(ypos < 600) {
            requestAnimationFrame(drawBottom);
        }
    });

}

function drawBottom() {
    var gr = context.createLinearGradient(0, 0, 800, 0);
    gr.addColorStop(0, "black");
    gr.addColorStop(1, "rgb" + currentColor);
    
    context.fillStyle = gr;
    context.fillRect(0,600, 800,650);
}

window.addEventListener("load", display("measurement"), false)