<?php

session_start();

require_once  "db_connection.php";

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ //if not session user AND not session adm > send to login page
    header("Location: login.php");
       }

//Animal Id
$id=$_GET["x"];

$sqlA="SELECT*FROM animals WHERE id=$id";
$resultA=mysqli_query($connect,$sqlA);
$rowA=mysqli_fetch_assoc($resultA);

//User Id
$sqlU="SELECT*FROM user WHERE id=$id";
$resultU=mysqli_query($connect,$sqlU);
$rowU=mysqli_fetch_assoc($resultU);

$new_owner_id= $_SESSION["user"] = $rowU["id"];


if(isset($_POST["adopt"])){
    $pet_id= $_POST["id"];
    $new_owner_id = $POST["id"];

$sql= "INSERT INTO `pet_adoption`(NEW_OWNER_ID, PET_ID) VALUES ($new_owner_id, $pet_id)";

if(mysqli_query($connect, $sql)){
    echo "<div class='alert alert-success' role='alert'>
    New record has been created, {$picture[1]}
  </div>";
  header("refresh: 3; url=index.php");
}else{
    echo "<div class='alert alert-danger' role='alert'>
    Error found,  {$picture[1]}!
  </div>";

}
}