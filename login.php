<h2>Sign in</h2>
<br>
<?php


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
   header("Location: userPage.php"); die();
}
?>

<form name="input" action="" method="post">
    <label for="username">Username:</label>
    <input type="text" value="" id="username" name="username" />
    <label for="password">Password:</label>
    <input type="password" value="" id="password" name="password" />
    <div class="error"><?= $errorMsg ?></div>
    <input type="submit" value="Sign inn" name="sub" />
  </form>

  <a href="http://158.39.188.206/steg1/signup/signup.php" >Don't have an account? Register here</a>
