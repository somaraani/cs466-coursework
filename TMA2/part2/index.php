<?php
    include('session.php');

    $username = "";
    $error = "";

    if(isset($_SESSION['user'])) {
        header("location: account.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        
        $query = "SELECT * FROM Users WHERE username='$username'";
        $result = $database->query($query)->fetch_array();
        
        if(empty($result) or $result['password'] != $_POST['password']) {
            $error = "Username or password is incorrect.";
        } else {
            $_SESSION['user'] = $result['username'];
            $_SESSION['lesson'] = $result['lesson'];
            header("location: account.php");
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
</head>

<body>

    <div class="header orange-back">
        <div class="padded-content">
            <h1>EduK8</h1>
        </div>
    </div>

    <div class="padded-content">
        <br />
        <p>Welcome to the EduK8 Learning Mangement System! Get started  by logging in or creating an account.</p>
        <br />
        <form method="post" action="index.php">
            <label >
                <p class="orange">Username</p>
                <input style="width: 500px;" type="text" name="username" maxlength="30" value="<?php print("$username"); ?>" required/>
            </label>
            <br />
            <label>
                <p class="orange">Password</p>
                <input style="width: 500px;" type="password" maxlength="30" name="password" required/>
            </label>
            <br />
            <br />
            <p class=error><?php print("$error")?></p>
            <input class="orange-btn" type="submit" value="Login" />
        </form>
        <br />
        <br />
        <a href="create.php"><p>Don't have an account? Create one instead.</p></a>
    </div>
   

</body>

</html>