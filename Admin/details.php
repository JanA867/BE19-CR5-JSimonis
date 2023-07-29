<?php 
require_once "../db_connection.php";

session_start();

if(isset($_SESSION["user"])){ //in case user try to exit index, only for adm
  header("Location: ../home.php");
}
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
  header("Location: ../login.php");
}

$id= $_GET["x"];

$sql= "SELECT * FROM animals WHERE id=$id"; //Join tables to see Supplier Information

$result=mysqli_query($connect, $sql);

$row= mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin="anonymous">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Details</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Create New</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Layout -->
<div class="container">
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-sx-1">
    <div class="mt-3">
    <p><img src="<?="../img/$row[picture]"?>" width="200"></p>
    <h2><?=$row["name"] ?></h2>
    <p>Breed: <?=$row["breed"] ?></p>
    <p>"<?=$row["description"] ?>"</p>
    <p>based in <?=$row["location"] ?></p>
    <hr>
    <p>size: <?=$row["size"] ?></p>
    <p>gender: <?=$row["gender"] ?></p>
    <p>age: <?=$row["age"] ?></p>
    <p>vaccinated: <?=$row["vaccinated"] ?></p>
    <p><?=$row["status"] ?></p>


    </div>
    </div>
</div>


<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

</body>
</html>