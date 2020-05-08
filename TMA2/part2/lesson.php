<?php 
    include('session.php');

    $username = "";

    if(!isset($_SESSION['user'])) {
        header("location: index.php");
    } else {
        $username = $_SESSION['user'];
    }

    if(array_key_exists('logout', $_POST)) {
        logout();
    }

    $id = $_GET['id'];

    if($_SESSION['lesson'] < $id) {
        header("location: index.php");
    }

    $statement = "SELECT * FROM Lessons WHERE id='$id'";
    $lesson = $database->query($statement)->fetch_array();


    //CHANGE FORMAT TO PROPER HTML]

    $content = str_replace("<text>", "[p]", $lesson['content']);
    $content = str_replace("</text>", "[/p]", $content);
    $content = str_replace("<heading>", "[h2]", $content);
    $content = str_replace("</heading>", "[/h2]", $content);
    $content = str_replace("<code>", "[code]", $content);
    $content = str_replace("</code>", "[/code]", $content);
    $content = str_replace("<list>", "[list]", $content);
    $content = str_replace("</list>", "[/list]", $content);
    $content = str_replace("<item>", "[item]", $content);
    $content = str_replace("</item>", "[/item]", $content);

    $content = str_replace("<", '&lt;', $content);
    $content = str_replace(">", '&gt;', $content);

    $content = str_replace("#!", '<span class="in-code">', $content);
    $content = str_replace("!#", '</span>', $content);

    $content = str_replace("[p]", "<p>", $content);
    $content = str_replace("[/p]", "</p>", $content);
    $content = str_replace("[h2]", "<h2>",$content);
    $content = str_replace("[/h2]", "</h2>", $content);
    $content = str_replace("[code]", '<div class="code">',$content);
    $content = str_replace("[/code]", "</div>", $content);
    $content = str_replace("[list]", '<ul>',$content);
    $content = str_replace("[/list]", "</ul>", $content);
    $content = str_replace("[item]", '<li>',$content);
    $content = str_replace("[/item]", "</li>", $content);

    $content = str_replace("##", '<br>', $content);
    $content = str_replace("#T#", '<br> &emsp;&emsp;', $content);
    $content = str_replace("#TT#", '<br> &emsp;&emsp;&emsp;&emsp;', $content);
    $content = str_replace("#TTT#", '<br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;', $content);
    $content = str_replace("#TTTT#", '<br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;', $content);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
    <script src="script.js"></script> 
</head>

<body>

    <div class="header orange-back">
        <div class="padded-content">
            <a href="account.php"><p class="back">&larr;</p></a>
            <h1>EduK8: <span class="name"> Lesson <?php print $lesson['id'] ?>. <?php print $lesson['name'] ?> </span> </h1>
            <div class="right">
                <p><?php print $_SESSION['user']?></p>
                <form method="post">
                    <input type="submit" name="logout" id="logout" value="Sign out" /><br/>
                </form>
            </div>
        </div>
    </div>

    <div class="eduk8 padded-content">        
        <?php print $content ?>
        <br />
        <h2>Lesson <?php print $lesson['id'] ?> Quiz</h2>
        <p>Finish quiz <?php print $lesson['id'] ?> to complete the lesson and unlock the next one. You must get all the questions correct to pass.</p>

        <?php if($_SESSION['lesson'] > $lesson['id']) : ?>
            <p class="green">You have already passed this quiz, but you can try it again.</p>
        <?php endif ?>

        <a href="quiz.php?id=<?php print $lesson['quiz'] ?>"><button class="orange-btn">Start Quiz</button></a>
    </div>
   

</body>

</html>