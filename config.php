<?php
    
    $_SESSION['login']= false;
    // 158.39.188.206
    $servername = "158.39.188.206";
    $username = "admin";
    $password = "datasikkerhet123";
    $db = "prosjekt";
    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $db);


?>