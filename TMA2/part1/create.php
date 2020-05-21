<?php 
    include('session.php');

    $error = '';
    $username = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $checkStatement = "SELECT COUNT(*) FROM Users where username='$username'";
        $result = $database->query($checkStatement)->fetch_array();

        if ((int)$result[0] >= 1) {
            $error = 'A user with that username already exists.';
        } else if(strlen($username) < 6) {
            $error = 'Username must be at least 6 characters.';
        } else if($password  != $_POST['repeated']) {
            $error = 'Passwords do not match!';
        } else if (strlen($password) < 8) {
            $error = 'Password is too short, must be at least 8 characters.';
        }

        //if no errors create 
        if($error == "") {
            $statement = "INSERT INTO Users(username, password) VALUES('$username', '$password')";

            if($database->query($statement) === true) {
                $_SESSION['username'] = $username; 
                header("location: index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
</head>

<body>
    <div class="header">
        <h1 class="padded">BookMarks</h1>
    </div>

    <div class="padded-content content">
        <p>Create your account to start saving bookmarks!</p>
        <div class="login">
            <form method = "post" action="create.php">
                <label>
                    <p>Username (must be at least 6 characters) </p>
                    <input type="text" name="username" value="<?php print("$username"); ?>" required >
                </label>
                <br />
                <label>
                    <p>Password (8 characters or longer)</p>
                    <input type="password" name="password" required>
                </label>
                <label>
                    <p>Repeat Password</p>
                    <input type="password" name="repeated" required>
                </label>
                <br />
                <br />
                <p class=error><?php print("$error")?></p>
                <input type="submit" value="Sign up" />
            </form>
            <br />
            <a href="index.php"><p>Already have an account? Log in instead.</p></a>
        </div>
    </div>
   

</body>

</html>