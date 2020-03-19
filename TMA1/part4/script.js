function read() {
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', '/measurement/tool.html', true);;
    httpRequest.onload = function () {
            var content = httpRequest.responseText;
            document.querySelector('#tool-content').innerHTML = content;
    };
    httpRequest.send();
}

window.addEventListener("load", read, false)