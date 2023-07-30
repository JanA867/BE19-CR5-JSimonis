<?php 

$hostname = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "be19_cr5_animal_adoption_jsimonis"; 


$connect = new mysqli($hostname, $username, $password, $dbname);

// check connection
if(!$connect) {
   die( "Connection failed: " . mysqli_connect_error() );
}

?>
