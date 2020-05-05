<?php

require ('../../database/database.php');
$conn = openDatabase();


$name = $_POST["name"];
$price=$_POST['price'];
$tickets=$_POST['tickets_available'];
$desc=$_POST['description'];
$filename = $_FILES['file']['name'];

$sql = "INSERT INTO `event` (`event_name`, `event_price`, `event_image`, `event_desc`, `tickets_available`, `tickets_left`) VALUES
('$name', '$price', '$filename', '$desc', '$tickets', '$tickets')";
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
   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      echo 'success';
   }else{
      echo 'failure';
   }
}






?>