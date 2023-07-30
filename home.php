<?php

session_start();


if(isset($_SESSION["adm"])){ 
    header("Location: dashboard.php");
    }

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ 
     header("Location: login.php");
        }
require_once "db_connection.php";

$sql="SELECT*FROM users WHERE id={$_SESSION["user"]}";
$result=mysqli_query($connect, $sql);
$row=mysqli_fetch_assoc($result);


$sqlAnimals="SELECT * FROM animals";
$resultAnimals=mysqli_query($connect, $sqlAnimals);

$layout="";

if(mysqli_num_rows($resultAnimals)>0){
while($rowAnimals=mysqli_fetch_assoc($resultAnimals)){
    $layout.= "<div>
    <div class='card' style='width: 18rem;'>
    <img src='img/{$rowAnimals["picture"]}' class='card-img-top' alt='...' height='250px'>
    <div class='card-body'>
      <h5 class='card-title'>{$rowAnimals["name"]}</h5>
      <a href='more.php?x={$rowAnimals["id"]}' class='btn btn-outline-warning'>Details</a>
      <a href='adoption.php?x={$rowAnimals["id"]}' class='btn btn-outline-info'>Adopt</a>
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
   <title>Welcome <?= $row["first_name"] ?></title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <nav class="navbar navbar-expand-lg bg-warning-subtle" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/<?= $row["picture"] ?> " alt="user pic" width="30" height="24">
            </a>
         <a class="nav-link" href="#"><span><?= $row["email"] ?></span></a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update.php?x=<?= $row["id"] ?>">editProfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <h2 class="text-center mt-3">Welcome <?= $row["first_name"] . " " . $row["last_name"] ?></h2>

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-sx-1 mt-3">
            <?=$layout?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>