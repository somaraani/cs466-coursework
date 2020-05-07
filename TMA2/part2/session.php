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

    $database = mysqli_connect("localhost", "root", "", "lms");
?>