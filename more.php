<?php 

require_once "db_connection.php";

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ 
    header("Location: login.php");
       }


$id= $_GET["x"];

$sql= "SELECT * FROM animals WHERE id=$id"; 

$result=mysqli_query($connect, $sql);

$row= mysqli_fetch_assoc($result);


$sqlUser="SELECT*FROM users WHERE id={$_SESSION["user"]}";
$resultUser=mysqli_query($connect, $sqlUser);
$rowUser=mysqli_fetch_assoc($resultUser);

$availability="";
if($row["status"] != 'adopted'){
  $availability= "<div class='badge bg-success text-wrap'>available</div>";
  }else{
    $availability= "<div class='badge bg-danger text-wrap'>adopted</div>";
      };
$vaccinated="";
      if($row["vaccinated"] == 2){
        $vaccinated= "<div class='badge bg-warning text-wrap'>yes</div>";
        }else{
          $vaccinated= "<div class='badge bg-danger text-wrap'>no</div>";
            };
      mysqli_close($connect);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $rowUser["first_name"] ?></title>
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin="anonymous">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/<?= $rowUser["picture"] ?> " alt="user pic" width="30" height="24">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<!-- Layout -->
<div class="container">
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-sx-1">
    <div class="mt-3">
    <p><img src="<?="img/$row[picture]"?>" width="200"></p>
    <h2><?=$row["name"] ?></h2>
    <p class="text-decoration-underline"><?=$row["breed"] ?></p>
    <p class="fst-italic">"<?=$row["description"] ?>"</p>
    <p>based in <?=$row["location"] ?></p>
    <hr>
    <p>size: <?=$row["size"] ?></p>
    <p>gender: <?=$row["gender"] ?></p>
    <p>age: <?=$row["age"] ?></p>
    <p>vaccinated: <?=$vaccinated?></p>
    <p class="fw-bold">Status: <?=$availability?></p>
    <a href="home.php" class="btn btn-outline-warning">Back to home page</a>


    </div>
    </div>
</div>


<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

</body>
</html>