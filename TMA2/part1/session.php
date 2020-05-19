<?php 
    if (!isset($_SESSION))
    {
      session_start();
    }

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $database = mysqli_connect($server, $username, $password, $db);
?>