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
    
    echo " email ok";
}

if( isset( $_GET['password']) && isset($_GET['password_conf']) ) {
    $password1 = $_GET['password'];
    $password2 = $_GET['password_conf'];
    if($password1 == $password2){
        $passcheck = true;
        echo "password ok";
    }
}

if( isset($_GET['firstname']) && isset($_GET['firstname']) ){
    $firstname = $_GET['firstname'];
    $lastname  = $_GET['lastname'];
    
    $namecheck = true;
}
if ( isset($_GET['class'])){
    $class = $_GET['class'];
    $classcheck = true;

}

    
if(isset($_GET['subjectList'])){
    $subject = $_GET['subjectList'];
    $subjectcheck = true;
    echo "subject ok";

    // sjekker om epost, passord, emne, og navn er hentet ordentlig
    if($emailcheck && $passcheck && $subjectcheck && $namecheck){

        //Opprettelse av Credential
        $sql = "INSERT INTO `Credentials` (`email`, `password`) VALUES ("."'".$email."'".","."'".$password1."'"." );";
        if ($conn->query($sql) === TRUE) {
            echo "bruker ble lagret.";

            //Opprettelse av student og knytter student til Credential
            $sql2 = "INSERT INTO `Student` (`firstname`, `lastname`, `email`, `studium`, `class`) VALUES ("."'".$firstname."'".", "."'".$lastname."'"." , "."'".$email."'"." , "."'".$subject."'".", "."'".$class."'".")";
            if ($conn->query($sql2) === TRUE){
                echo "student lagret.";
            }


        } else {
        echo "Noe gikk galt, bruker ikke lagret";
    }
   
}

         

?>