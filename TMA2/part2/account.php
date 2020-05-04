<?php 
    include('session.php');

    $username = "";

    if(!isset($_SESSION['user'])) {
        header("location: index.php");
    } else {
        $username = $_SESSION['user'];
    }

    function logout() {
        session_destroy();
        header("location: index.php");
    }

    if(array_key_exists('logout', $_POST)) {
        logout();
    }

    //get all lessons 
    $statement = "SELECT * FROM Lessons";
    $lessons = $database->query($statement)->fetch_all();
    
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
            <h1>EduK8</h1>
            <div class="right">
                <p><?php print $_SESSION['user']?></p>
                <form method="post">
                    <input type="submit" name="logout" id="logout" value="Sign out" /><br/>
                </form>
            </div>
        </div>
    </div>

    <div class="eduk8 padded-content">

        <?php if($_SESSION['lesson'] == 0) : ?>
            <p>You haven't started any lessons yet. Start by clicking on lesson 1 below!</p>
        <?php endif; ?>

        <h1>Available Lessons:</h1>
        
        <?php foreach ($lessons as $lesson) : ?>

            <?php if($_SESSION['lesson'] == $lesson[0]) : ?>
                <a href='lesson.php?id=<?php echo $lesson[0] ?>'>
                    <div class="lesson">
                        <h2><?php echo $lesson[0] . ". " . $lesson[1] ?></h2>
                        <p class="status">available</p>
                    </div>
                </a>
            <?php elseif($_SESSION['lesson'] > $lesson[0]) : ?>
                <a href='lesson.php?id=<?php echo $lesson[0] ?>'>
                    <div class="available lesson">
                        <h2><?php echo $lesson[0] . ". " . $lesson[1] ?></h2>
                        <p class="status">completed</p>
                    </div>
                </a>
            <?php else : ?>
                <div class="missing lesson">
                    <h2><?php echo $lesson[0] . ". " . $lesson[1] ?></h2>
                    <p class="status">missing pre-requisite</p>
                </div>
            <?php endif; ?>

            <br />

        <?php endforeach ?>

        
    </div>
   

</body>

</html>