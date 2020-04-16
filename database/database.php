<?php
// class database{

	define("HOSTNAME","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DBNAME","eventplatform");

function openDatabase(){

	$conn = new mysqli(HOSTNAME,USERNAME,PASSWORD,DBNAME) OR DIE("Connection failed!");

	return $conn;

}

function closeDatabase($conn){
	
    $conn -> close();
 }

// }


?>