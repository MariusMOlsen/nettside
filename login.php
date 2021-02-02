<h2>Sign in</h2>
<br>
<?php
require 'config.php';

$errorMsg = "";
$validUser = false;
if(isset(  $_GET['username']) && isset( $_GET['password'])) {
    $email = $_GET['username'];
    $password = $_GET['password'];

    //Sjekk om det finnes Credentials med den kobinasjonen av brukernavn og passord.
    $loginValidaton = "SELECT email FROM Credentials WHERE email ="."'".$email."'"." AND password = '".$password."';";
    $result = $conn->query($loginValidaton);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userEmail = $row['email'];
            $validUser = true;
        }
    }
    $_SESSION['role'] ="test";
    if($validUser){
        //sjekk om den innloggede brukeren er en Student eller Teacher.
        $findRole = "SELECT id, email FROM Student WHERE email = "."'".$email."';";
        $_SESSION['email'] = $email;
        $result = $conn->query($findRole);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['role'] = "student";
                $_SESSION['studentId'] = $row['id'];
            }
        } 
        // Lagrer data i session
        else{

            $getSessionData = "SELECT *  FROM Teacher WHERE email ="."'".$email."';";
            $result = $conn->query($getSessionData);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['teacherId'] = $row['id'];
                    
                }
            }
            $_SESSION['role'] = "teacher";

        }

    }
    


}

// legg til destinasjon poå hvor man skal ende opp ved suksessfull innlogging
if($validUser) {
  
  header("Location: userpage.php"); //die();
  
}
?>
