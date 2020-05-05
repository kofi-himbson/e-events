<?php

require ('../../database/database.php');
$conn = openDatabase();

$sql = "SELECT * FROM admin";
$results = $conn->query($sql);

$username = $_POST['username'];
$password = $_POST['password'];


foreach($results as $result){
    if($result['username'] == $username && $result['password'] == $password){
        echo 'success';
    }else{
        echo 'failure';
    }
}


?>