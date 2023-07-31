<?php

session_start();

require_once  "db_connection.php";

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ 
    header("Location: login.php");
       }

//Animal Id über Pos + Value
$pet_id=$_GET["x"];
//User Id über Session
$new_owner_id= $_SESSION["user"];

$result= mysqli_query($connect, "SELECT status FROM animals WHERE id=$pet_id"); //ob animal adoted
$available= mysqli_fetch_assoc($result); //holt Daten für check 
if($available["status"] === "available"){ //vergleicht ob available
  $sql= "INSERT INTO `pet_adoption`(NEW_OWNER_ID, PET_ID, DATE) VALUES ($new_owner_id, $pet_id, NOW())"; //neuer Eintrag in DB
  
  if(mysqli_query($connect, $sql)){ //wenn erfolgreich:  echo
      echo "<div class='alert alert-success' role='alert'>Successfully adopted
    </div>";
    mysqli_query($connect, "UPDATE `animals` SET `status`='adopted' WHERE id = $pet_id"); //wenn erfolgreich: update status
    header("refresh: 3; url=home.php"); //leite weiter
  }else{
      echo "<div class='alert alert-danger' role='alert'>Error
    </div>";
    header("refresh: 3; url=home.php");
  }
}
else{ //wenn schon adotiert: echo
  echo "<div class='alert alert-danger' role='alert'>Already adopted 
    </div>";
    header("refresh: 3; url=home.php");
}

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Dashboard <?= $row["first_name"] ?></title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>


