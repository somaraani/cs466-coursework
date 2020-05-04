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

    $database = mysqli_connect("localhost", "root", "", "lms");
?>