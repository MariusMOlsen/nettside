<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Login</title>
</head>
<body>
    <?php
        if(isset($_GET['logout'])){
          session_destroy();
        }
        require 'config.php';
        

        if(isset($_GET['pinEnter'])){
          $getCourse = "SELECT * from Course WHERE pin ="."'".$_GET['pinCode']."';";
          $result3 = $conn->query($getCourse);
          $subjectId;
          if ($result3->num_rows > 0) {
              while($row3 = $result3->fetch_assoc()) {
                $subjectId = $row['id'];
                $_SESSION['role']="guest";
              }
              
          header('Location: http://158.39.188.206/steg1/course.php?selectedCourse='.$subjectId);
          }
          else{
            echo "ugyldig pin";
          }
          
        }

          
    ?>

  
    <form name="input" action="http://158.39.188.206/steg1/login.php" method="get">
        <label for="username">Username:</label>
        <input type="text" value="" id="username" name="username" />
        <label for="password">Password:</label>
        <input type="password" value="" id="password" name="password" />
        <div class="error"></div>
        <input type="submit" value="Sign inn" name="sub" />
    </form>

  <a href="http://158.39.188.206/steg1/signup/signup.php" >Don't have an account? Register here</a>
  <a href="http://158.39.188.206/steg1/index.php?logout=true">log Out</a>


  <h2>Sign in with subject-PIN</h2>
    <form action="" method="GET">
    <label for="">Skriv inn 4-siffret PIN</label>
    <input type="text"name="pinCode">
    <input type="submit" value="Enter" name="pinEnter" >
    </form>
</html>