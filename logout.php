<?php
    session_start();

    // if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    // {
    //     header("location: login.php");
    //     exit;
    // }

    session_unset();
    session_destroy();
    header("location: welcome.php");
    exit;
?>