<?php

require ('../../database/database.php');
$conn = openDatabase();

$event_id = $_POST['event_id'];

$sql = "SELECT * FROM conference_registration WHERE conf_id = '$event_id'";
$results = $conn->query($sql);
$output='';

if($results){
foreach($results as $result){
    $output.= '<tr>'.
    '<td>'.$result['name'].'</td>'.
    '<td>'.$result['email'].'</td>'.
    '<td>'.$result['number'].'</td>'.
    '</tr>'; 
}
echo $output;
}

?>