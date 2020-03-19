var currLink = undefined;

function display(link, obj, i) {

    if (currLink != link) {
        // get content from local file
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', link + ".html", true);
        httpRequest.onload = function () {
            var content = httpRequest.responseText;
            document.querySelector('#content').innerHTML = content;
        };
        httpRequest.send();

        // make current section selected
        if (obj != null) {
            document.getElementsByClassName('selected')[0].classList.remove("selected");
            var node = obj.parentElement;
            while (true) {
                if (node.classList && node.classList.contains('header')) {
                    node.classList.add('selected');
                    break;
                }
                node = node.previousSibling;
            }
        }

        currLink = link;
        quiz(link);
    }

    // scroll to correct section
    window.setTimeout(function () {
        if (i != null) {
            document.getElementById(i).scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            window.scrollTo({ top: '0', behavior: 'smooth' });
        }
    }, 100);
}

function quiz(name) {
    // get content from local file
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', name + '.xml', true);
    httpRequest.onload = function () {
        var quiz = document.getElementById("quiz");
        quiz.innerHTML += "<form>";

        var content = httpRequest.responseXML;
        var questions = content.getElementsByTagName("question");

        for (let index = 0; index < questions.length; index++) {
            const question = questions[index].getElementsByTagName("description")[0].firstChild.nodeValue;
            quiz.innerHTML += "<h1>" + question + "</h1>"
            const answers = questions[index].getElementsByTagName("option");
            for (let ans = 0; ans < answers.length; ans++) {
                const answerText = answers[ans].firstChild.nodeValue;
                quiz.innerHTML += '<label><input name="' + index + '" type="radio"/>' + answerText + '<label/>';
            }
        }

        quiz.innerHTML += '<input class="submit" type="submit"/>'
        quiz.innerHTML += "<form/>"

    };
    httpRequest.send();
}

window.addEventListener("load", display("home"), false);