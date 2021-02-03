<?php 
    require '../config.php';

    $password_valid = false;
    $email_valid    = false;
    $subject_valid  = false;
    $image_valid    = false;
    $name_valid     = false;
    $error="";



if(isset($_GET['sub'])){

    if( isset($_GET['lecturer_email']) ){
        // sjekk om eposten allerede er i bruk
        $email = $_GET['lecturer_email'];
        $password_valid = true;
    }

    if( isset($_GET['firstname']) && isset($_GET['lastname']) ){
        $firstname = $_GET['firstname'];
        $lastname  = $_GET['lastname'];

        $name_valid = true;
    }

    if( isset($_GET['password'])  && isset($_GET['password_conf']) ){

        // sjekk om passordene stemmer overens
        if($_GET['password'] == $_GET['password_conf']){
            
            $password = $_GET['password'];
            $email_valid    = true;
        }else{
            $error = $error." Passordene er ikke like. <br>";
        }
        
    }


    if( isset($_GET['subject']) && isset($_GET['subjectCode']) && isset($_GET['subjectPin']) ){
        $subject     =  $_GET['subject'];
        $subjectCode =  $_GET['subjectCode'];
        $subjectPin  =  $_GET['subjectPin'];

        $subject_valid  = true;
    }
        // Sjekker om passord, email, subject, og navn er skrevet inn riktig.
    if( $password_valid && $email_valid && $subject_valid && $name_valid){
        
        $sql = "INSERT INTO `Teacher` (`firstname`, `lastname`, `email`, `imagename`, `admin`) VALUES ("."'".$firstname."'"."  , "."'".$lastname."'"." ,"."'".$email."'"." , '/uploads/standard.jpg', "."'".NULL."'".");";       
        
        //Kjør sql spørring og opprett teacher
        if($conn->query($sql)){
            
             // Hent teacherID
            $hentTeacherId = "SELECT id  FROM Teacher WHERE email ="."'".$email."';";
            
            $result = $conn->query($hentTeacherId);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $teacherId = $row['id'];
                }
            }

            // Opprettelse av Credential
            $sqlCred = "INSERT INTO `Credentials` (`email`, `password`) VALUES ("."'".$email."'".","."'".$password."'"." );";
            if($conn->query($sqlCred)){
                
            }
            //Opprettelse av course
            $sql2="INSERT INTO `Course` (`id`, `coursecode`, `pin`, `teacherId`,`courseName`) VALUES (NULL,"."'".$subjectCode."'". " ," ."'".$subjectPin."'"."," ."'".$teacherId."'".","."'".$subject."'".");";
            if($conn->query($sql2)){
                header("Location:http://158.39.188.206/steg1/index.php?login=OK");
        }
           
        }else{
            header("Location:http://158.39.188.206/steg1/signup/signup.php?login=FEILET");
        }
        
        
         
         
        
       
    }

    
}



?>