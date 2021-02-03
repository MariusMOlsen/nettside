<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Login</title>
</head>
<body>
    <?php
        include 'config.php';
        if($_SESSION['role'] === "student"){
          
        
            $getSubjectList = "SELECT *  FROM Course;";
              
            $result = $conn->query($getSubjectList);
            $subjectList;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $subjectList .= "<option value="."'".$row['id']."'".">".$row['courseName']."</option>";
                }
            }
            

        } elseif($_SESSION['role'] === "teacher"){
          
            $getSubjectList = "SELECT *  FROM Course WHERE teacherId="."'".$_SESSION['teacherId']."';";
              
            $result = $conn->query($getSubjectList);
            $subjectList;

           
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $subjectList .= "<option value="."'".$row['id']."'".">".$row['courseName']."</option>";
                  ;
                }
            }  
        }

        
        
        

        
    ?>

   

    <H1>Din side </H1>
    <?PHP
    if( $_SESSION['role'] == 'teacher' ){
      
      echo "<img src='".$_SESSION['imagename']."'><br><br>";
        }
        ?>

   

    <form action="http://158.39.188.206/steg1/course.php" method="get">
      <select name="selectedCourse" id="">
          <?php echo $subjectList; ?>
      </select>
    <input type="submit" value="Choose subject" name="sub" >
    </form>



    <br><br><br>
    <form action="" method="post">
    <label for="">Change password</label>
    <br>
    <input type="password" name="password1">
    <br>
    <input type="password" name="password2">
    <br>
    <input type="submit" value="Change password" name="btnPasswordChange">
    </form>

    <?php 
        if( isset($_POST['btnPasswordChange']) && isset($_POST['password1']) && isset($_POST['password2']) ){
          if($_POST['password1'] == $_POST['password2']){
              $sqlChangePassword =" UPDATE `Credentials` SET `password` = "."'".$_POST['password1']."' WHERE `Credentials`.`email` = "."'".$_SESSION['email']."';";
              if ($conn->query($sqlChangePassword) === TRUE){
                  echo "Passordet er byttet.";
              }
          }else{
              echo "Passordet er ikke like, prøv igjen.";
          }
          


        }else{
          echo "Noe gikk galt, prøv å fyll inn feltene på nytt.";
        }

        if( $_SESSION['role'] == 'teacher' ){
            echo"<form action='upload.php' method='post' enctype='multipart/form-data'>
            Choose a profile picture:
            <input type='file' name='fileToUpload' id='fileToUpload'>
            <input type='submit' value='Upload Image' name='submit'>
          </form>";

        }
    ?>


</body>
</html>