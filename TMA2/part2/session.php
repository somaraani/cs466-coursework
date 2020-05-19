<?php 
    if (!isset($_SESSION))
    {
      session_start();
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function logout() {
      session_destroy();
      header("location: index.php");
    }


    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $database = mysqli_connect($server, $username, $password, $db);

?>
