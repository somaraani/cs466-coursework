<?php 
    if (!isset($_SESSION))
    {
      session_start();
    }

    $database = mysqli_connect("localhost", "root", "", "bookmarks");
?>