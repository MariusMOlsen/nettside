<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    
  <title>Login</title>
</head>
<body>
    <?php
        include '../config.php';
        if( isset($_GET['login']) ){
            echo "Feltene er ikke fylt inn riktig, prøv igjen. <br><br><br>";
        }
     
        
    ?> 
        <div class="form-group">
            <span><b>Do you want to register a student or lecturer?</b></span> &nbsp;<div class="btn-group" id="status" data-toggle="buttons">
            <form method="post">
                <label class="btn btn-default btn-on">
                <input type="radio" value="1" name="gamemode" checked="checked">Student</label>
                <label class="btn btn-default btn-off active">
                <input type="radio" value="0" name="gamemode" >Lecturer</label>
                <input type="submit" value="submit" name="submit">
            </form>  
        </div>
    <?php

        if(isset($_POST['gamemode'])){
            
            if( $_POST['gamemode'] == 1){
                include 'signup_student.php';
                
            }
            if( $_POST['gamemode'] == 0){ 
                
                include 'signup_lecturer.php';
                
            }
        }
    ?>
        
    


 
</body>
</html>