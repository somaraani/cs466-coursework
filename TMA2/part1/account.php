<?php 
    include('session.php');

    $message = "";
    $username = "";
    $bookmarks = array();

    if(!isset($_SESSION['username'])) {
        header("location: index.php");
    } else {
        $username = $_SESSION['username'];
        getBookmarks();
    }

    function logout() {
        session_destroy();
        header("location: index.php");
    }

    function getBookmarks() {
        global $username, $database, $bookmarks;
        $statement = "SELECT * FROM Bookmarks WHERE username='$username'";
        $bookmarks = $database->query($statement)->fetch_all();
    }

    function delete($id) {
        global $database;
        $statement = "DELETE FROM Bookmarks where id=$id";
        $database->query($statement);
        getBookmarks();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['name'])) {
        $name = $_POST['name'];

        //format url
        $url = preg_replace("(^https?:\/\/(www.)?)", "", $_POST['url']);
        $url = rtrim($url, '/');

        $checkStatement = "SELECT COUNT(*) FROM Bookmarks WHERE username='$username' AND url='$url'";
        $result = $database->query($checkStatement)->fetch_array();

        $id = $_POST['id'];

        if (isset($id) and $id != -1) {
            $message = "Bookmark $name updated.";
            $statement = "UPDATE Bookmarks SET name='$name', url='$url' where id='$id'";
            $database->query($statement);
            getBookmarks();
        } else if((int)$result[0] >= 1) {
            $message = "You already have this page bookmarked!";
        } else if(!empty($name) and !empty($url) and !empty($username)) {
            $statement = "INSERT INTO Bookmarks(name, url, username) VALUES('$name', '$url', '$username')";
            $database->query($statement);
            getBookmarks();
        } 
    }

    if(array_key_exists('logout', $_POST)) {
        logout();
    } else if(array_key_exists('remove', $_POST)) {
        delete($_POST['id']);
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../shared/style.css">
    <script src="script.js"></script> 
</head>

<body>

    <div id="dimmer" class="dim">  
    </div>

    <div class="header">
        <h1 class="padded">BookMarks</h1>
        <div class="right">
        <p><?php print $_SESSION['username']?></p>
        <form method="post">
            <input type="submit" name="logout" id="logout" value="Sign out" /><br/>
        </form>
        </div>
    </div>

    <div id="overlay" class="overlay">
        <form method = "post" action="account.php">
            <label>
                <p>Bookmark name</p>
                <input id="name" maxlength="50" type="text" name="name" required/>
            </label>
            <br />
            <label>
                <p>Bookmark URL</p>
                <input id="url" maxlength="256" type="url" name="url" required/>
            </label>
            <input class="bookmark-button" id="submit" type="submit" value="Save" />
            <input class="bookmark-button" id="edit-id" type="hidden" name="id" value="-1"> 
        </form>
        <button onclick="hideOverlay()"> Cancel </button>
    </div>

    <div class="content">

        
        <h2 id="create" onclick="showOverlay()"> + create new bookmark</h2>

        <p><?php print $message?></p>

        <?php  if (count($bookmarks) == 0) {
            echo "<p>You have no bookmarks yet.</p>";
        }?>
        
        <br />
            
        <div class="bookmark-container">
            <?php foreach ($bookmarks as $bookmark) : ?>
                <div class="bookmark">
                    <a target="_blank" href="<?php echo "http://" . $bookmark[2] ?>"><h1><?php echo $bookmark[1] ?></h1></a>
                    
                    <button onclick="edit(<?php echo "'$bookmark[0]', '$bookmark[1]', '$bookmark[2]'" ?>)">Edit</button>

                    <br />

                    <form method = "post" action="account.php">
                        <input type="hidden" name="id" value="<?php echo $bookmark[0] ?>"> 
                        <input type="submit" name="remove" value="Remove" />
                    </form>
                </div>
            <?php endforeach ?>

            <span></span>
        </div>
        
        
    </div>
   

</body>

</html>