-- CREATE TABLES ------------------

CREATE TABLE Students (
    username VARCHAR(30) PRIMARY KEY NOT NULL,
    password VARCHAR(30) NOT NULL,
    lesson INT NOT NULL
);

CREATE TABLE Lessons (
    id INT(6) unsigned AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    quiz INT(30) NOT NULL
);

CREATE TABLE Quizes(
    id INT NOT NULL, 
    content TEXT NOT NULL
);


-- INSERT LESSONS --------------- 

INSERT INTO Lessons VALUES(1, "Intro to HTML", '<text>This unit will teach you the most basic buiding blocks of any website or web application. That is HTML.</text>
<heading>1.1 Basics of HTML</heading>
<text>HTML is the basic building block of most websites. HTML stands for Hypertext Markup Language, and is what defines the content and structure of a webpage.</text>
<text>To get started, open your text editor and create a new file. Call it index.html.</text>
<text>Paste the following code into your textfile, and save it.</text>
<code>
##<!DOCTYPE html>
##<html>
##<head>
#T#<title>Website title</title>
##</head>
##<body>
#T#<h1>A heading</h1>
#T#<p>Some text here</p>
##</body>
##</html>
</code>
<text>The first line #!<!DOCTYPE html>!# specifies that this is an HTML document.</text>
<text>HTML syntax is made up of tags, that are enclosed in #!<>!#</text>
<text>Most tags need to be closed by having a #!/!# in the closing tag. As you can see from the example, the #!<body>!# tag is closed by #!</body>!#. That is the same for both #!h1!# and #!p!#.</text>
<text>Enclosed in the #!html!# tags is all the HTML content for this page. The #!head!# tag contains metadata about the website such as the website #!title!# which you see in your browser tab. The #!body!# specifies the content that is visible on the webpage.</text>
<text>#!h1!# is a header, and #!p!# specifies a paragraph. There are many elements in HTML. The next section covers some of them.</text>
<text>This is a very basic HTML file. Open the file in a browser to see its output.</text>
<heading>1.2 Basics of HTML</heading>
<text>One of the most important structures in HTML are headers. As you saw in the previous example, h1 created a big header. There are 6 levels of headers in HTML. They are shown below.</text>
<code>
##<!DOCTYPE html>
##<html>
##<body>
#T#<h1>Heading 1</h1>
#T#<h2>Heading 2</h2>
#T#<h3>Heading 3</h3>
#T#<h4>Heading 4</h4>
#T#<h5>Heading 5</h5>
#T#<h6>Heading 6</h6>
##</body>
##</html> 
</code>
<text>Another important HTML element is #!div!#, which lets you define different sections. Generally, different portions of the webpage are split into different divs. The following example shows two different divs that correspond to different sections. We also show one more element, #!hr!#, which defines a horizontal line / break.</text>
<code>
##<!DOCTYPE html>
##<html>
##<body>
#T#<div>
#TT#<h1>Section 1</h1>
#TT#<p>This is the first section</p>
#T#</div>
#T#<hr/>
#T#<div>
#TT#<h1>Section 2</h1>
#TT#<p>This is the second section</p>
#T#</div>
##</body>
##</html> 
</code>
<text>HTML allows you to have lists. There are two types: ordered lists #!ol!# and unordered lists #!ul!#. Inside the list, you specify list items using the tag #!li!#.</text>
<code>
##<!DOCTYPE html>
##<html>
##<body>
#T#<ol>
#TT#<li>First item</li>
#TT#<li>Second item</li>
#TT#<li>Third item</li>
#T#</ol>
#T#<ul>
#TT#<li>First item</li>
#TT#<li>Second item</li>
#TT#<li>Third item</li>
#T#</ul> 
##</body>
##</html> 
</code>
<heading>1.3 Input Types</heading>
<text>HTML also allows having #!input!#. To have input, it is specified inside a #!form!#. You can create different forms for different input groups and have as many inputs in a form as you like.</text>
<text>To specify the type of input, you must specify the property #!type!#. These are some examples of types available in HTML. </text>
<list>
    <item>text: Allows a regular text input</item>
    <item>number: Only allows numbers</item>
    <item>checkbox: Adds a checkbox that can be checked or unchecked</item>
    <item>radio: Adds a radio button which only allows one selection at a time</item>
    <item>date: Allows specifying a date input</item>
    <item>reset: Button that clears the form</item>
</list>
<text>You can also add descriptions to your inputs by wrapping the input in a #!label!# tag.</text>
<text>Here is an example that uses all of those input types:</text>
<code>
##<!DOCTYPE html>
##<html>
##<body>
#T#<form>
#TT#<label>Text<input type="text"/></label>
#TT#<label>Number<input type="number"/></label>
#TT#<label>Checkbox<input type="checkbox"/></label>
#TT#<label>Radio 1<input name="example" type="radio"/></label>
#TT#<label>Radio 2<input name="example" type="radio"/></label>
#TT#<label>Date<input type="date"/></label>
#TT#<label>Reset<input type="reset"/></label>
#T#</form>
##</body>
##</html> 
</code>
<text>The radio button input uses the property name to link the two radio buttons together. As you can see, only one of them can be selected at a time, as only one value should be present.</text>', 1);

INSERT INTO Lessons VALUES(2, "Scripting in Javascript", '<text>This unit will introduce you to scripting in Javascript. Javascript runs client side in the browser. By using javascript we can add extra functionality and logic to a website or web applicaiton. </text>
<heading>2.1 Introduction</heading>
<text>To add javascript code to our website, we must add it in the header section using the #!script!# tag.</text>
<code>
##<!DOCTYPE html>
##<html>
#T#<head>
#TT#<title>Website title</title>
#TT#<script type="text/javascript">
#TTT#document.writeln("<h1>Javascript works!</h1>")
#TT#</script>
#T#</head>
#T#<body>
#T#</body>
##</html> 
</code>
<text>The #!type!# attribute tells the browser that our script is javascript text.</text>
<text>The #!document!# object represents the currently displayed html page in the browser. The #!writeln!# method on the document object writes a new line. Inside the method we pass a string argument which is the html code to add. </text>
<text>Since all our script does is add a header to our HTML document, this is the same as having that header in the body. That isnt a very useful script, so lets try to add some more functionality to it.</text>
<code>
##<!DOCTYPE html>
##<html>
#T#<head>
#TT#<title>Website title</title>
#TT#<script type="text/javascript">
#TTT#today = new Date()
#TTT#document.writeln("<h1>The date is ")
#TTT#document.write(today + "</h1>")#TT#</script>
#TT#</script>
#T#</head>
#T#<body>
#T#</body>
##</html> 
</code>
<text>This script will display the current date. </text>
<text>Javascript has a #!Date!# object. An object is a type that has a state and properties (fields). To create a new object in Javascript, you use the keyword #!new!#. For example, to create a date we use #!new Date()!#, which creates a date object with todays date.</text>
<text>The #!write!# method on document will write content without adding a new line, where as #!writeln!# will add a new line after it adds the content. </text>
<text>You can test this out by yourself. Copy the contents in the example into a .html file, and run it in your web browser.</text>
<text>While you can put Javascript code in your HTML file using the tag, this is not recommended. The better way is to have your javascript code in a seperate file, and reference it in your HTML document. </text>
<code>
##<!DOCTYPE html>
##<html>
#T#<head>
#TT#<title>Website title</title>
#TT#<script type="text/javascript" src="script.js" >
#TT#</script>
#T#</head>
#T#<body>
#T#</body>
##</html> 
</code>
<text>The #!src!# attribute stands for "source" and will point towards an external file that contains your javascript code. Generally javascript files have the extention .js</text>
<heading>2.2 Functions</heading>
<text>Javascript allows you to define functions. Functions are blocks of code that can have a return value, and that you can run when you like. The following example will demonstrate a basic usage of a function. </text>
<code>
##<!DOCTYPE html>
##<html>
#T#<head>
#TT#<title>Website title</title>
#TT#<script type="text/javascript">
#TTT#function test() {}
#TTTT#alert("Inside the function!")
#TTT#document.write(today + "</h1>")#TT#</script>
#TT#</script>
#T#</head>
#T#<body>
#TT#<button onclick="test()">Click Me!</button>
#T#</body>
##</html> 
</code>
<text>The #!onclick!# attribute for a button allows you to specify Javascript code to run when the button is clicked. Here I set it to run the function test. The #!alert!# function in Javascript will create an alert in your browser.</text>
<heading>2.3 Events </heading>
<text>Sometimes we want things to happen automatically without user input. We can achieve this using events. Events are responses to things happening in your HTML page. For example, Javascript has a #!load!# event. The load event is fired whenever the HTML object is fully loaded. We can use this to automatically run certain functions or scripts when the page loads. </text>
<code>
##function test() {
#T#alert("This will run automatically!")
##}
##
##window.addEventListener("load", test, false) 
</code>
<text>In that example, we add an eventListener to the #!window!# object. The window object contains everything in the current web page. An eventListener will "listen" to check if the event we specified has happened. In this case, we specify the load event. We also specify to run the test function when the event fires. The last argument will always be false and is beyond the scope of this course. </text>
<text>There are many events available in Javascript. For example, there is the mouseover event which fires whenever the cursor enters a certain element. There is also onkeypress event which happens when a user clicks a key on their keyboard. </text>', 2);

INSERT INTO Lessons VALUES(3, "XML & Ajax", '<text>This unit will introduce you to XML & AJAX. Those technologies can help make your web applications more modular and externalize some of your data. </text>
<heading>3.1 XML</heading>
<text>XML or extensible markup language is a format that allows you to format data in a way that is easy for both a human and a machine to read. XML is great for storing data that is sent accross web applications or to make easily editable forms. For example, the quizes that you see at the end of each unit are stored as XML files. This makes it easy to add new tests or modify existing ones, since all you need to do is modify the XML file, and the Javascript code will build the quiz from the updated XML file.</text>
<text>Here is what the quizes look like </text>
<code>
##<quiz>
#T#<question>
#TT#<description>Question text here</description>
#TT#<options>
#TTT#<option>option 1</option>
#TTT#<option correct="true">option 2</option>
#TTT#<option>option 3</option>
#TTT#<option>option 4</option>
#TT#</options>
#T#</question>
##
#T#<question>
#TT#...
##
</quiz>
</code>
<text>Much like the HTML code you have learned so far, XML uses tags and attributes to format its data. </text>
<text>An XML file must have only one root (top level) tag. In this case, our root tag is #!quiz!#. In our options, we use the attribute #!correct="true"!# to define the correct answer, and our code looks for that when creating it. You can format your data however you like, as long as its consistent and logical. </text>
<text>You can create XML Schemas. These define rules and constraints for your XML data. For example, we can create a schema for the quiz that forces us to have at least one question in the quiz, and also confirms that the quiz has valid description, the options section, and at least one question that is correct. You can use a XML Validators, that tell you if a certain XML file is valid and complete against your schema.</text>
<heading>3.2 AJAX</heading>
<text>Ajax, or Asynchronous Javascript and XML is a method for asynchronously downloading data in your web applications. This allows you to download data and use it to modify your webpage without needing to refresh it. For example, this web application uses AJAX technology to load the different units. When you select one of the units in the left hand side, it calls a method which loads the content for the selected unit from a seperate HTML file, for example unit3.html and displays its content. </text>
<code>
##var request = new XMLHttpRequest()
##request.onreadystatechange = function () {
#T#if (request.readyState == 4 && request.status == 200) {
#TT#alert(request.responseText)
#T#}
##}
##request.open("GET", "yourfile.txt", true) 
##request.send() 
</code>
<text> This code first creates a new #!XMLHttpRequest!# object, which is what allows us to download the files. Then we add a state changed event listener to the request object. This allows us to define what happens with the data when it is downloaded. In this example, we just output the responseText (which is the downloaded data) as an alert. The open function allows us to specify that we want to #!"GET"!# or download the file. Lastly, we send the request we just created. </text>', 3);

-- INSERT Quizes --------------- 

INSERT INTO Quizes
VALUES (1, '<quiz>
<question>
<description>Which of the following tags does all your html code go in?</description>
<options>
<option>body</option>
<option correct="true">html</option>
<option>code</option>
<option>web</option>
</options>
</question>

<question>
<description>Which is the biggest heading tag you can have in HTML?</description>
<options>
<option>p</option>
<option>h6</option>
<option correct="true">h1</option>
<option>h0</option>
</options>
</question>

<question>
<description>Which of the following tags denotes a list that has an order?</description>
<options>
<option correct="true">ol</option>
<option>list</option>
<option>ul</option>
<option>ordered</option>
</options>
</question>

<question>
<description>How do you link two radio inputs together such that only one can be selected at a time?</description>
<options>
<option>Place both options in the same "input" tag</option>
<option>Put them right after each other</option>
<option correct="true">Set the same name attribute</option>
<option>Place both in the same "label" tag</option>
</options>
</question>

<question>
<description>What does the "div" tag denote?</description>
<options>
<option>A horizontal divider</option>
<option correct="true">A related section in the website</option>
<option>The end of a paragraph</option>
<option>A page in the website</option>
</options>
</question>
</quiz>'); 

INSERT INTO Quizes
VALUES (2, '<quiz>
<question>
<description>Where is the best place to put your Javascript code?</description>
<options>
<option>Inside the body tag</option>
<option>Inside a script tag in the header</option>
<option correct="true">In a seperate file</option>
<option>Inside a buttons onclick attribtue</option>
</options>
</question>

<question>
<description>Which of the following methods adds code to the document without inserting a new line?</description>
<options>
<option>document.println(code)</option>
<option correct="true">document.write(code)</option>
<option>document.writeln(code)</option>
<option>document.add(code)</option>
</options>
</question>

<question>
<description>Which file extention is usually used for Javascript files?</description>
<options>
<option>.javascript</option>
<option correct="true">.js</option>
<option>.script</option>
<option>.sc</option>
</options>
</question>

<question>
<description>Which of the following events is fired when the object is loaded?</description>
<options>
<option correct="true">"load"</option>
<option>"onload"</option>
<option>"loaded"</option>
<option>"hasloaded"</option>
</options>
</question>

</quiz>'); 


INSERT INTO Quizes
VALUES (3, '<quiz>
<question>
<description>How many root elements does an XML file have?</description>
<options>
<option>As many as you want</option>
<option correct="true">Only one</option>
<option>Upto 1000</option>
<option>At least one</option>
</options>
</question>
<question>
<description>What is the benefit of using ajax?</description>
<options>
<option>Makes your webpage load faster</option>
<option correct="true">Updates content without refreshing</option>
<option>Lets you format your data</option>
<option>None of the above</option>
</options>
</question>
<question>
<description>What does an XML Validator do?</description>
<options>
<option>Allows you to specify restrictions on an XML file</option>
<option>Allows you to set the format of your data</option>
<option correct="true">Runs an XML file against a schema</option>
<option>None of the above</option>
</options>
</question>
<question>
<description>
Which of the following methods on XMLHttpRequest allows you to specify which file to fetch?
</description>
<options>
<option correct="true">open</option>
<option>fetch</option>
<option>send</option>
<option>get</option>
</options>
</question>
</quiz>'); 