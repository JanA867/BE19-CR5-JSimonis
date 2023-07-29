<?php

session_start();

require_once "db_connection.php";

$sqlAnimals="SELECT * FROM animals WHERE `age` > 8 ";
$resultAnimals=mysqli_query($connect, $sqlAnimals);

$layout="";

if(mysqli_num_rows($resultAnimals)>0){
while($rowAnimals=mysqli_fetch_assoc($resultAnimals)){
    $layout.= "<div>
    <div class='card bg-info-subtle mt-2 mb-2' style='width: 18rem;'>
    <img src='img/{$rowAnimals["picture"]}' class='card-img-top' alt='...' height='250px'>
    <div class='card-body'>
      <h5 class='card-title'>{$rowAnimals["name"]}</h5>
      <p>{$rowAnimals["breed"]}</p>
      <p>Age: {$rowAnimals["age"]}</p>
      <p>based in {$rowAnimals["location"]}</p>
      <a href='login.php' class='btn btn-outline-info'>Adopt</a>
    </div>
    </div>
    </div>";
}
}else{
    $layout.= "No results found";
}

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome</title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <nav class="navbar navbar-expand-lg bg-warning-subtle" >
        <div class="container-fluid">
         <a class="nav-link fs-4 fst-italic" href="#">SensualShelter</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <div class="content bg-light-subtle">
    <div class="head">
    <h2 class="text-center pt-2">Meet our Pets</h2>
<div class="buttons d-flex justify-content-center">
<a class="btn btn-outline-danger me-3 ms-3 mt-2 mb-2" href="welcome.php">Show All</a>
<a class="btn btn-outline-warning me-3 ms-3 mt-2 mb-2" href="#">Seniors</a>
</div>
    </div>
    <div class="container ">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-sx-1 mt-3">
            <?=$layout?>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>