
<?php
    $errorMsgEmail="";
    $errorMsgPassword="";
    $errorMsgSubject="";

    $password_valid = false;
    $email_valid    = false;
    $subject_valid  = false;

    

    if(isset($_POST['sub'])){

        if( isset($_POST['lecturer_email']) ){
            // sjekk om eposten allerede er i bruk
            $password_valid = true;
        }

        if( isset($_POST['password'])  && isset($_POST['password_conf']) ){
            // sjekk om passordene stemmer overens
            $email_valid    = true;
        }


        if( isset($_POST['subject'])){
            // sjekk om det finnes et emne med samme 'subject' navn

            $subject_valid  = true;
        }

        if( $password_valid && $email_valid && $subject_valid){
            // dersom de innfylte feltene er godkjent, opprett brukeren.
        }

        //header("Location: /userPage.php");
    }

    


?>
<h2>Register Lecturer</h2>

<form action="" method="post">
    <label for="" name="">Enter email</label>
    <input type="text" name="lecturer_email">
    <div class="error"><?= $errorMsgEmail ?></div>

    <label for="">Password</label>
    <input type="text" name="password">
    <br>
    <label for="">Confirm Password</label>
    <input type="text" name="password_conf">
    <br>
    <label for="">Create subject</label>
    <input type="text" name="subject">
    <div class="error"><?php $errorMsgsubject ?></div>
    <label for="">kode på 4 siffer</label>
    <input type="text" name="subjectCode">
    <br>
    <input type="submit" value="Register" name="sub" >
</form>
