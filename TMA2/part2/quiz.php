<?php 
    include('session.php');

    $username = "";
    $correct = -1;
    $totalLessons = 999;

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

    $statement = "SELECT * FROM Quizes WHERE id='$id'";
    $quiz = $database->query($statement)->fetch_array();
    $xml = simplexml_load_string($quiz['content']);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correct = 0;
        for($i = 0; $i < count($xml->children()); $i++) {
            $selected = $_POST["$i"];
            $isCorrect = $xml->question[$i]->options->option[(int)$selected]->attributes()->correct;
            if(isset($isCorrect) and $isCorrect == "true") {
                $correct = $correct + 1;
            }
        }

        if($correct == count($xml->children()) and $_SESSION['lesson'] == $id) {
            $lesson = $id + 1;
            $statement = "UPDATE Students SET lesson='$lesson' where username='$username'";
            $database->query($statement);
            $_SESSION['lesson'] = $lesson;
        }

        $totalQuery = "SELECT COUNT(*) FROM Lessons";
        $totalLessons = $database->query($totalQuery)->fetch_array()[0];

    }
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
    <script src="script.js">
    </script> 
  </head>
  <body>

    <div class="header orange-back">
      <div class="padded-content">
        <a href="account.php">
          <p class="back">&larr;
          </p>
        </a>
        <h1>EduK8: 
          <span class="name"> Quiz 
            <?php print $id ?> 
          </span> 
        </h1>
        <div class="right">
          <p>
            <?php print $_SESSION['user']?>
          </p>
          <form method="post">
            <input type="submit" name="logout" id="logout" value="Sign out" />
            <br/>
          </form>
        </div>
      </div> 
    </div>

    <div class="eduk8 padded-content">        
      <?php if($correct == -1) : ?>
      <p>Finish quiz 
        <?php print $id ?> to complete the lesson and unlock the next one.
      </p>
      <form method="post" action="quiz.php?id=<?php print $id ?>">
        <ol>
          <?php for ($q = 0; $q < count($xml->children()); $q++) : ?>
          <li>
            <p>
              <?php echo $xml->question[$q]->description?>
            </p>
            <?php for($a = 0; $a < 4; $a++) : ?>
            <input type="radio" value="<?php echo $a ?>" name="<?php echo $q ?>" required>
            <label>
              <?php echo $xml->question[$q]->options->option[$a] ?>
            </label>
            <br>
            <?php endfor ?>
            <br />
          </li>
          <?php endfor ?> 
          <br />
          <input class="orange-btn" type="submit" value="Submit" />
        </ol>
      </form>
      <?php else : ?>

        <?php if($correct == count($xml->children())) : ?>
            <h2>You passed!</h2>
        <?php else :?>
            <h2>You failed</h2>
        <?php endif; ?>

      <p>
        You got <?php echo($correct . "/" . count($xml->children())); ?>
      </p>

      <?php if($correct == count($xml->children())) : ?>

            <?php if($id == $totalLessons) : ?>
              <p>You have completed the final available lesson! Nice job :) </p>
            <?php else : ?>
              <p>You have gained access to lesson <?php print $id + 1 ?> </p>
            <?php endif ; ?>

            <br />
            <br />
            <a href="account.php"><button class="orange-btn">View Lessons</button></a>
        <?php else :?>
            <p>You can review the material of lesson <?php print $id ?> again <a href="lesson.php?id=<?php print $id ?>">here</a> and then try again later. Or you can try again now.</p>
            <a href="quiz.php?id=<?php print $id ?>"><button class="orange-btn">Try Again</button></a>
        <?php endif; ?>

      <?php endif; ?>
    </div>
  </body>
</html>
