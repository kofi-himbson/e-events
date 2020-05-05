<?php

require ('../../database/database.php');
$conn = openDatabase();

$name = $_POST["conference_name"];
$desc=$_POST['conference_description'];
$seats_available = $_POST['seats_available'];
$seats_left = $_POST['seats_available'];
$filename = $_FILES['image']['name'];

$sql = "INSERT INTO `conference` (`conf_name`,`conf_desc`, `conf_seats_available`, `conf_seats_left`,`conf_image`) VALUES
('$name', '$desc', '$seats_available', '$seats_left', '$filename')";
$result = $conn->query($sql);


// /* File Location */
$location = "../../images/".$filename;
$uploaded = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);


// /* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
// /* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploaded = 0;
}

if($uploaded == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['image']['tmp_name'],$location)){
      echo 'success';
   }else{
      echo 'failure';
   }
}

?>