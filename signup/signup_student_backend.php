<?php 
    require '../config.php';

    $emailcheck = false;
    $passcheck = false;
    $subjectcheck = false;
    $namecheck = false;
    $classcheck= false;
    $error;

    



if(isset($_GET['student_email'])){
    $email = $_GET['student_email'];
    $emailcheck = true;
    
   
}

if( isset( $_GET['password']) && isset($_GET['password_conf']) ) {
    $password1 = $_GET['password'];
    $password2 = $_GET['password_conf'];
    if($password1 == $password2){
        $passcheck = true;
        
    }
}

if( isset($_GET['firstname']) && isset($_GET['firstname']) ){
    $firstname = $_GET['firstname'];
    $lastname  = $_GET['lastname'];
    
    $namecheck = true;
}
if ( isset($_GET['class'])){
    $class = $_GET['class'];
    $currentYear = date("Y");
    if($class <2023){
        $classcheck = true;
    }
    

}

    
if(isset($_GET['subjectList'])){
    $subject = $_GET['subjectList'];
    $subjectcheck = true;
    

    // sjekker om epost, passord, emne, og navn er hentet ordentlig
    if($emailcheck && $passcheck && $subjectcheck && $namecheck && $classcheck){

        //Opprettelse av Credential
        $sql = "INSERT INTO `Credentials` (`email`, `password`) VALUES ("."'".$email."'".","."'".$password1."'"." );";
        if ($conn->query($sql) === TRUE) {
           

            //Opprettelse av student og knytter student til Credential
            $sql2 = "INSERT INTO `Student` (`firstname`, `lastname`, `email`, `studium`, `class`) VALUES ("."'".$firstname."'".", "."'".$lastname."'"." , "."'".$email."'"." , "."'".$subject."'".", "."'".$class."'".")";
            if ($conn->query($sql2) === TRUE){
               header("Location:http://158.39.188.206/steg1/index.php?login=OK");
            }


        } else {
        header("Location:http://158.39.188.206/steg1/signup/signup.php?login=FEILET");
    }
   
}else {
    header("Location:http://158.39.188.206/steg1/signup/signup.php?login=FEILET");
    
}

}

         

?>