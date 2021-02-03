<h2>Sign in</h2>
<br>
<?php
require 'config.php';


$validUser = false;

// Sjekk om GET data er generert
if(isset(  $_GET['username']) && isset( $_GET['password'])) {
    $email = $_GET['username'];
    $password = $_GET['password'];

    //Sjekk om det finnes Credentials med den kobinasjonen av brukernavn og passord.
    $loginValidaton = "SELECT email FROM Credentials WHERE email ="."'".$email."'"." AND password = '".$password."';";
    $result = $conn->query($loginValidaton);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userEmail = $row['email'];
            if($userEmail != ""){
                $validUser = true;
            }
            
        }
    }

    // Sjekk om brukeren er en gyldig bruker
    if($validUser){
        //sjekk om den innloggede brukeren er en Student, dersom den er det lagres tilhørende bruker id og rolle i session
        $findRole = "SELECT id, email FROM Student WHERE email = "."'".$email."';";
        $_SESSION['email'] = $email;
        $result = $conn->query($findRole);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['role'] = "student";
                $_SESSION['studentId'] = $row['id'];
            }
        }

        //sjekk om den innloggede brukeren IKKE er en Student, dersom den er det lagres tilhørende bruker id og rolle i session
        else{

            $getSessionData = "SELECT *  FROM Teacher WHERE email ="."'".$email."';";
            $result = $conn->query($getSessionData);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['teacherId'] = $row['id'];
                    $_SESSION['imagename'] = $row['imagename'];
                    
                }
            }
            $_SESSION['role'] = "teacher";

        }

    }
    


}

// Dersom brukeren er gyldig, videresend brukeren til "Min side" med hvor brukeren kan bytte passord og se emner.
if($validUser) {
  
  header("Location: userpage.php"); //die();
  
}else{
    header("Location: index.php?error= epost og passord kombinasjonen er feil.");
}
?>
