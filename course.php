<?php 

require 'config.php';

// Hent Kursnavn
$sqlGetCourseName = "SELECT * FROM Course WHERE id="."'".$_GET['selectedCourse']."';";
$result3 = $conn->query($sqlGetCourseName);
if ($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        $courseName = $row3['courseName'];
    }
}

//  Print velkomsmelding
echo "<h2>"."Velommen til kurs: ".$courseName."</h2>";

// dersom "Send" knappen er trykket:
if(isset($_POST['msgSent'])){

    //INSERT INTO `Message` ( `message`, `studentId`, `courseId`) VALUES ('Test Melding', '1', '1');
    $createMessage = "INSERT INTO `Message` ( `message`, `studentId`, `courseId`) VALUES ("."'".$_POST['txtMsg']."','".$_SESSION['studentId']."','".$_GET['selectedCourse']."');";
    if($conn->query($createMessage)){
        echo "melding registrert.";
    }
    else{
        echo "melding ikke registrert.";
    }
}


if(isset($_POST['replySent'])){

    if($_SESSION['role']== "guest"){
        
        // opprettelse av gjestekommentar
        $createGuestComment = "INSERT INTO GuestComment ( message, messageId) VALUES ("."'".$_POST['msgReply']."','".$_POST['msgId']."');";
        if ($conn->query($createGuestComment)){
            echo "GuestReply lagret.";
        }
    }
    elseif($_SESSION['role'] == "teacher"){
        $didTeacherReply = false;

        //Sjekk om foreleser har besvart
        $checkIfTeacherReplied = "SELECT * from TeacherResponse WHERE messageId ="."'".$_POST['msgId']."' AND teacherId ='".$_SESSION['teacherId']."';";
        $result2 = $conn->query($checkIfTeacherReplied);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $didTeacherReply = true;
            }
        }

        // opprettelse av svar fra teacher dersom foreleser ikke har besvart
        if(!$didTeacherReply){
            $createTeacherResponse = "INSERT INTO `TeacherResponse` ( `message`, `messageId`, `teacherId`) VALUES ( "."'".$_POST['msgReply']."','".$_POST['msgId']."','".$_SESSION['teacherId']."');";
            if ($conn->query($createTeacherResponse)){
                echo "TeacherReply lagret.";
            }
        }
        
    }
    //HER MÅ FORELESER KUNNE SVARE PÅ EN MELDING
    
}

//Hent alle Messages
$getMessages = "SELECT *  FROM Message WHERE courseId="."'".$_GET['selectedCourse']."';";
$messages;            
$result = $conn->query($getMessages);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        // variabel som holder på alle kommentarer fra guest og teacher
        $commentHolder="";

        // Hent alle Gjestekommentarer på hver message
        $getGuestComment = "SELECT * from GuestComment WHERE messageId ="."'".$row['id']."';";
        $result2 = $conn->query($getGuestComment);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $commentHolder .= "<div class='messageReply'value='".$row2['id']."'>".$row2['message']."</div>";
            }
        }

        // Hent alle TeacherReplies på hver message
        $getTeacherResponse = "SELECT * FROM TeacherResponse WHERE messageId ="."'".$row['id']."';";
       
        $result3 = $conn->query($getTeacherResponse);
        if ($result3->num_rows > 0) {
            while($row3 = $result3->fetch_assoc()) {
                
                $commentHolder .= "<div class='messageReplyTeacher'value='".$row3['id']."'>".$row3['message']."</div>";
            }
        }

        

        if($_SESSION['role'] == "student"){

            $messages = "<div class='message'value='".$row['id']."'>".$row['message']."</div>".$commentHolder;
            echo $messages;

        }else{
            $messages = "<form action='' method='post'>
                        <div class='message'  value='".$row['id']."'>".$row['message']."</div>"."
                        ".$commentHolder."
                        <input type='text' name='msgReply'>
                        <input type='hidden' value='".$row['id']."' name='msgId'>
                        <input type='submit' value='Svar' name='replySent'>
                        </form> ";       
            echo $messages;
        }
        
    }
    
}  


?>


<html>
    <head>
        <style>
            .message{
                border: solid black 1px;
                padding: 15px;
                margin:10px;

            }

            
        </style>
    </head>

    <body>
            
        <?php 
    
            if( $_SESSION['role'] == 'guest' ||  $_SESSION['role'] == 'student'){
                echo "
                <form action='' method='post'>
                <label for=''>Write a new message</label>
                <input type='text' name='txtMsg'>
                <input type='submit' value='Send' name='msgSent'>
                </form>";
            }
        
            
        ?>
        

    </body>
</html>


