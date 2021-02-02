<?php 

require 'config.php';

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
    if($_SESSION['role']="guest"){
        echo "msgID: ".$_POST['msgReply'];
        $createGuestComment = "INSERT INTO GuestComment ( message, messageId) VALUES ("."'".$_POST['msgReply']."','".$_POST['msgId']."');";
        if ($conn->query($createGuestComment)){
            echo "GuestReply lagret.";
        }
    }
    //HER MÅ FORELESER KUNNE SVARE PÅ EN MELDING
    
}

//Hent alle Messages
$getMessages = "SELECT *  FROM Message;";
$messages;            
$result = $conn->query($getMessages);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $commentHolder="";
        $getGuestComment = "SELECT * from GuestComment WHERE messageId ="."'".$row['id']."';";
        $result2 = $conn->query($getGuestComment);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $commentHolder .= "<div class='messageReply'value='".$row2['id']."'>".$row2['message']."</div>";
            }
        }

        $getTeacherResponse = "SELECT * from TeacherResponse WHERE messageId ="."'".$row['id']."';";
        $result3 = $conn->query($$getTeacherResponse);
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
        <form action="" method="post">
        <label for="">Write a new message</label>
        <input type="text" name="txtMsg">
        <input type="submit" value="Send" name="msgSent">
        </form>

    </body>
</html>


