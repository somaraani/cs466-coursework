function display(link, obj, i) {
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', link, true);
    httpRequest.onload = function () {
        var content = httpRequest.responseText;
        document.querySelector('#content').innerHTML = content;
    };
    httpRequest.send();

    // make current selected
    if (obj != null) {
        document.getElementsByClassName('selected')[0].classList.remove("selected");

        var node = obj.parentElement;
        while (true) {
            if(node.classList && node.classList.contains('header')) {
                node.classList.add('selected');
                break;
            }

            node = node.previousSibling;
        }

    }

    if (i != null) {
        document.getElementById(i).scrollIntoView({
            behavior: 'smooth'
        });
    }
}

window.addEventListener("load", display("home.html"), false);