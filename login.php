<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Login</title>
</head>
<body>
<?php
include 'config.php';

$errorMsg = "";
$validUser = false;
if(isset($_POST["sub"])) {
    
    // Denne linjen verifiserer innlogginsinfo, her blir det sjekk mot database
    $validUser = $_POST["username"] == "admin" && $_POST["password"] == "password";
    if(!$validUser){
    $errorMsg = "Invalid username or password.";
    } 
   
}

// legg til destinasjon poå hvor man skal ende opp ved suksessfull innlogging
if($validUser) {
   header("Location: /signup.php"); die();
}
?>

<form name="input" action="" method="post">
    <label for="username">Username:</label>
    <input type="text" value="" id="username" name="username" />
    <label for="password">Password:</label>
    <input type="password" value="" id="password" name="password" />
    <div class="error"><?= $errorMsg ?></div>
    <input type="submit" value="Home" name="sub" />
  </form>
  </body>
</html>