<!DOCTYPE html>
<html>
<body>



</body>
</html>


<?php
require 'config.php';

$generateName = (time()*1000);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Someting went wrong.";
    $uploadOk = 0;
  }

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The FIle has been uploaded.";
    $sqlUpdateImageName= "UPDATE Teacher SET imagename = "."'".$target_file."' WHERE id ='".$_SESSION['teacherId']."';";
    if ($conn->query($sqlUpdateImageName) === TRUE){}
    $_SESSION['imagename']=$target_file;
    header("Location: http://158.39.188.206/steg1/userpage.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  

}
?>