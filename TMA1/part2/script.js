var currLink = undefined;
var correctAnswers = [];

function display(link, obj, i) {

    if (currLink != link) {
        // get content from local file
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', link + ".html", true);
        httpRequest.onload = function () {
            var content = httpRequest.responseText;
            document.querySelector('#content').innerHTML = content;

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

            window.scrollTo(0, 0);
            updateQuizes();
        };
        httpRequest.send();
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

function updateQuizes() {
    const quizes = document.getElementsByTagName("quiz");

    if (quizes.length == 0) {
        return;
    }

    for (let i = 0; i < quizes.length; i++) {
        // get content from local file
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', quizes[i].getAttribute("name") + '.xml', true);
        httpRequest.onload = function () {

            var quiz = quizes[i];

            quiz.innerHTML = "";
            correctAnswers = [];

            //create form
            var content = httpRequest.responseXML;
            var questions = content.getElementsByTagName("question");

            for (let index = 0; index < questions.length; index++) {
                //add questions
                const question = questions[index].getElementsByTagName("description")[0].firstChild.nodeValue;
                quiz.innerHTML += `<h1>${question}</h1>`;

                const answers = questions[index].getElementsByTagName("option");
                for (let ans = 0; ans < answers.length; ans++) {
                    //add answers
                    const answerText = answers[ans].firstChild.nodeValue;
                    quiz.innerHTML += `<label><input name="${index}" type="radio"/>${answerText}<label/>`;

                    if (answers[ans].getAttribute("correct") == "true") {
                        correctAnswers.push(answers[ans].firstChild.nodeValue);
                    }
                }
                quiz.innerHTML += `<p id="result${index}"></p>`;
            }

            //finish forms
            quiz.innerHTML += '<button id="submitbtn" onclick="submit()">Submit Quiz</button>';
            quiz.innerHTML += '<button id="tryagainbtn" onclick="updateQuizes()">Try Again</button>';
            quiz.innerHTML += '<p id="total"></p>';

            document.getElementById("tryagainbtn").hidden = true;

        };

        httpRequest.send();
    }
}

//submits and grades quiz
function submit() {

    //make sure all questions were answers
    if (document.querySelectorAll('input:checked').length != correctAnswers.length) {
        document.getElementById("total").innerText = "Please answer all questions before submitting.";
        document.getElementById("total").classList.add("wrong");
        return;
    }

    //mark answers
    var correct = 0;
    for (let i = 0; i < correctAnswers.length; i++) {
        const selected = document.querySelector(`input[name="${i}"]:checked`).nextSibling.data;
        const resElement = document.getElementById("result" + i);

        console.log(selected)
        if (selected == correctAnswers[i]) {
            resElement.innerText = "Correct!";
            resElement.classList.add("right");
            correct++;
        } else {
            resElement.innerText = "Correct answer is: " + correctAnswers[i];
            resElement.classList.add("wrong");
        }
    }

    //show total
    document.getElementById("total").innerText = `You got ${correct}/${correctAnswers.length} (${correct / correctAnswers.length * 100}%)`;
    document.getElementById("total").classList = "orange";

    document.getElementById("submitbtn").hidden = true;
    document.getElementById("tryagainbtn").hidden = false;
}

window.addEventListener("load", display("home"), false);