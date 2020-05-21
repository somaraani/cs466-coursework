<?php
    include('session.php');

    $username = "";
    $error = "";

    $popular = array();

    if(isset($_SESSION['username'])) {
        header("location: account.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        
        $query = "SELECT * FROM Users WHERE username='$username'";
        $result = $database->query($query)->fetch_array();
        
        if(empty($result) or $result['password'] != $_POST['password']) {
            $error = "Username or password is incorrect.";
        } else {
            $_SESSION['username'] = $result['username'];
            header("location: account.php");
        }
    }

    $statement = "select url from Bookmarks group by url order by count(url) desc LIMIT 10;";
    $popular = $database->query($statement)->fetch_all();

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
</head>

<body>

    <div class="header">
        <div class="padded-content">
            <h1>BookMarks</h1>
        </div>
    </div>

    <div class="padded-content content">
        <p>Welcome to BookMarks! Please login to view your bookmarks, or view the most popular bookmarks below.</p>

        <div class="login">
            <form method="post" action="index.php">
                <label>
                    <p>Username</p>
                    <input type="text" name="username" maxlength="30" value="<?php print("$username"); ?>" required/>
                </label>
                <br />
                <label>
                    <p>Password</p>
                    <input type="password" maxlength="30" name="password" required/>
                </label>
                <br />
                <br />
                <p class=error><?php print("$error")?></p>
                <input type="submit" value="Login" />
            </form>
            <br />
            <a href="create.php"><p>Don't have an account? Create one instead.</p></a>
        </div>
        <br />
        <h2>Popular Bookmarks</h2>

        <ol>

            <?php foreach ($popular as $bookmark) : ?>
                <li><a target="_blank" href="http://<?php echo $bookmark[0]?>"><?php echo $bookmark[0] ?></a></li>
            <?php endforeach ?>

        </ol>

    </div>
   

</body>

</html>