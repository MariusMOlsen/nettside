<?php 
include '../config.php';

$getSubjectList = "SELECT *  FROM Course;";
              
    $result = $conn->query($getSubjectList);
    $subjectList;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $subjectList .= "kursid: ".$row['id']." kursnavn: ".$row['courseName']."<br>";
        }
    }
    echo $subjectList;



?>