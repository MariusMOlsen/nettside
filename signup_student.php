
<?php
    // denne skal vi senere hente fra databasen
    $subjectList = "<option value="."'".'INFPROG'."'".">Innføring I programmering</option>";

    $errorMsgEmail="";
    $errorMsgPassword="";
    $errorMsgSubject="";

    $password_valid = false;
    $email_valid    = false;
    $subject_valid  = false;

    

    if(isset($_POST['sub'])){

        if( isset($_POST['student_email']) ){
            $sql = "SELECT id FROM Students WHERE email=".'"'.$_POST['student_email'].'"';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                }
                $errorMsgEmail="There is already a user with that username";
              } else {
                $errorMsgEmail ="User doens't exist";
                $email_valid    = true;
              }
            
            
            
        }

        if( isset($_POST['password'])  && isset($_POST['password_conf']) ){
            // sjekk om passordene stemmer overens
            $password_valid = true;
        }


        if( isset($_POST['subject'])){
            // sjekk om det finnes et emne med samme 'subject' navn

            $subject_valid  = true;
        }

        if( $password_valid && $email_valid && $subject_valid){
            // dersom de innfylte feltene er godkjent, opprett brukeren.
            //header("Location: /userPage.php");
        }

    }

    


?>
<h2>Register student</h2>

<form action="" method="post">
    <label for="" name="">Enter email</label>
    <input type="text" name="student_email">
    <div class="error"><?= $errorMsgEmail ?></div>

    <label for="">Password</label>
    <input type="text" name="password">
    <br>
    <label for="">Confirm Password</label>
    <input type="text" name="password_conf">
    <br>
    <label for="">Enter subject</label>
    <select name="subjectList" id="subject">
        <?php echo $subjectList ?>
    </select>
    <div class="error"><?php $errorMsgsubject ?></div>
    <br>

    <input type="submit" value="Register" name="sub" >
</form>
