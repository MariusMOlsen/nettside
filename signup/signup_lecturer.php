
<?php

    

    $errorMsgEmail="";
    $errorMsgPassword="";
    $errorMsgSubject="";

    $password_valid = false;
    $email_valid    = false;
    $subject_valid  = false;

    

    
    


?>
<h2>Register Lecturer</h2>

<form action="http://158.39.188.206/steg1/signup/signup_lecturer_backend.php" method="get">
    <label for="" name="">Enter email</label>
    <input type="text" name="lecturer_email">
    <div class="error"><?= $errorMsgEmail ?></div>
    <br>
    <label for="">Password</label>
    <input type="text" name="password">
    <br>
    <label for="">Firstname</label>
    <input type="text" name="firstname">
    <br>
    <label for="">Lastname</label>
    <input type="text" name="lastname">
    <br>
    <label for="">Confirm Password</label>
    <input type="text" name="password_conf">
    <br>
    <label for="">Create subject</label>
    <input type="text" name="subject">
    <br>
    <label for="">Emnekode</label>
    <input type="text" name="subjectCode">
    <br>
    <div class="error"><?php $errorMsgsubject ?></div>
    <label for="">kode på 4 siffer</label>
    <input type="text" name="subjectPin">
    <br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Register" name="sub" >
</form>
