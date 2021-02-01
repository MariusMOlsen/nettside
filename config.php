<?php
    
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $_SESSION['login']= false;
    // 158.39.188.206
    $servername = "localhost";
    $username = "admin";
    $password = "datasikkerhet123";
    $db = "prosjekt";
    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $db);


?>