<?php 
require(__DIR__.'/functions/functions.php'); 

$conn = openDatabase();
$id=$_GET['id'];
$sql = "DELETE FROM cart WHERE cart_id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Record deleted successfully')</script>";
    header('location:cart.php');
    
} else {
    echo "<script>Error deleting record </script>" . mysqli_error($conn);
    header('location:cart.php');
}









?>
