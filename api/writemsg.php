<?php 
include '../config.php';
//158.39.188.206/steg1/api/writemsg.php?melding=&kursid
// henter kun en student ID som kan knyttes til melding. Spiller ingen rolle hvilken

if(isset($_GET['melding']) && isset($_GET['kursid'])){

    $createMessage = "INSERT INTO `Message` ( `message`, `studentId`, `courseId`) VALUES ("."'".$_GET['melding']."','4','".$_GET['kursid']."');";
    if($conn->query($createMessage)){
        return true;
        
    }else{ return false;
    }

}




?>