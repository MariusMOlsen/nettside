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
          echo"teacherId:".$_SESSION['teacherId'];
            $getSubjectList = "SELECT *  FROM Course WHERE teacherId="."'".$_SESSION['teacherId']."';";
              
            $result = $conn->query($getSubjectList);
            $subjectList;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $subjectList .= "<option value="."'".$row['id']."'".">".$row['courseName']."</option>";
                }
            }  
        }



    ?>

   

    <H2>Hey dear <?php echo $_SESSION['role']."med studentId: ".$_SESSION['studentId'] ?></H2>

    Her skal studenten kunne se hvilke emner han har og gå inn på de ulike emnene, studenten  skal også kunne bytte passord.
    <form action="http://158.39.188.206/steg1/course.php" method="get">
      <select name="selectedCourse" id="">
          <?php echo $subjectList; ?>
      </select>
    <input type="submit" value="Choose subject" name="sub" >
    </form>


</body>
</html>