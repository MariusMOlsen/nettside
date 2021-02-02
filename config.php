<?php
    session_start();
    ini_set('display_errors', 'off');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);



    // 158.39.188.206
    $servername = "localhost";
    $username = "admin";
    $password = "datasikkerhet123";
    $db = "prosjekt";
    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $db);


?>