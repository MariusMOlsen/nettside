
<?php
    require '../config.php';




    $URL = "http://158.39.188.206/steg1/signup/signup_student_backend.php";
    $formdestination;
    
    // denne skal vi senere hente fra databasen
    $subjectList = "<option value="."'".'INFPROG'."'".">Innføring I programmering</option>";

    $errorMsgEmail="";
    $errorMsgPassword="";
    $errorMsgSubject="";

    $emailcheck = false;
    $passcheck = false;
    $subjectcheck = false;


if(isset($_GET['student_email'])){
    $email = $_GET['student_email'];
    $emailcheck = true;
    var_dump($email);

}
if( isset( $_GET['password']) && isset($_GET['password_conf']) ) {
    $password1 = $_GET['password'];
    $password2 = $_GET['password_conf'];
    if($password1 == $password2){
        $passcheck = true;
        
    }


}

    
if(isset($_GET['subject'])){
    $subject = $_GET['subject'];
    $subjectcheck = true;
    if($emailcheck && $passcheck && $subjectcheck ){
        $formdestination= $URL."?email=".$email."&password=".$password1."&password2=".$password2."&subject=".$subject;
    }else{
        echo "vennligst fyll inn alle felter.";
    }
}

            
     



//"http://158.39.188.206/steg1/signup/signup_student_backend.php"."?email=".$email."&password=".$password1."&password2=".$password2."&subject=".$subject "


?>



<h2>Register student</h2>

<form action="http://158.39.188.206/steg1/signup/signup_student_backend.php" method="get" enctype="multipart/form-data">
    <label for="" name="">Enter email</label>
    <input type="text" name="student_email">
    <div class="error"><?= $errorMsgEmail ?></div>

    <label for="">Password</label>
    <input type="text" name="password">
    <br>
    <label for="">Confirm Password</label>
    <input type="text" name="password_conf">
    <br>
    <label for="">Enter Firstname</label>
    <input type="text" name="firstname">
    <br>
    <label for="">Lastname</label>
    <input type="text" name="lastname">
    <br>
    <label for="">Enter subject</label>
    <select name="subjectList" id="subject">
        <?php echo $subjectList ?>
    </select>
    <br>
    <label for="">Årskull</label>
    <input type="number" name="class">
    <div class="error"><?php $errorMsgsubject ?></div>
    <br>

    <input type="submit" value="Register" name="sub" >
</form>
