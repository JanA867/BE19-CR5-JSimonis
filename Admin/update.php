<?php
require_once "../db_connection.php";
require_once "../file_upload.php";

session_start();

if(isset($_SESSION["user"])){ //in case user try to exit index, only for adm
  header("Location: ../home.php");
}
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
  header("Location: ../login.php");
}

$id= $_GET["x"];
$sql= "SELECT * FROM animals WHERE id=$id";
$result= mysqli_query($connect, $sql);
$row= mysqli_fetch_assoc($result);


// $resultSupplier=mysqli_query($connect, "SELECT * FROM suppliers");
// $options="";

// while($supRow=mysqli_fetch_assoc($resultSupplier)){
//     if($row["fk_supplierId"]==$supRow["supplierId"]){ //difference to create compare ids (fk)
//         $options.="<option selected value='{$supRow["supplierId"]}'>{$supRow["sup_name"]}</option>";
//     }else{
//         $options.="<option value='{$supRow["supplierId"]}'>{$supRow["sup_name"]}</option>";

//     }
// }

if(isset($_POST["update"])){
    $name= $_POST["name"];
    $breed= $_POST["breed"];
    $age= $_POST["age"];
    $size= $_POST["size"];
    $vaccinated= $_POST["vaccinated"];
    $gender= $_POST["gender"];
    $location= $_POST["location"];
    $description= $_POST["description"];
    $picture=fileUpload($_FILES["picture"], "entry"); //, "product"

    if($_FILES["picture"]["error"]==0){
        if($row["picture"] != "Placeholder.png"){
            unlink("../img/$row[picture]");
        }
        $sql = "UPDATE `animals` SET `name`='$name',`breed`='$breed',`age`=$age, `size`='$size',`vaccinated`='$vaccinated',`gender`='$gender', `location`='$location', `description`='$description',`picture`='$picture[0]' WHERE id=$id ";
    }else{
        $sql = "UPDATE `animals` SET `name`='$name',`breed`='$breed',`age`='$age', `size`='$size', `vaccinated`='$vaccinated',`gender`='$gender', `location`='$location', `description`='$description' WHERE id=$id ";
    }

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin="anonymous">
</head>
<body>
    
<!-- Form -->
<div class="container mt-5">
       <h2>Update entry</h2>
       <form method="POST" enctype= "multipart/form-data">
        <!-- Name -->
           <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Name</label>
               <input  type="text" class="form-control" id="name" aria-describedby="name" 
name="name" value="<?=$row["name"]?>">
            </div>
            <!-- Breed -->
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" class="form-control"  id="breed"  aria-describedby="breed"  name="breed" value="<?=$row["breed"]?>">
            </div>
            <!-- Age -->
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control"  id="age"  aria-describedby="age"  name="age" value="<?=$row["age"]?>">
            </div>
            <!-- Description -->
            <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control"  id="description"  aria-describedby="description"  name="description" value="<?=$row["description"]?>">
            <!-- <span class="input-group-text">Write text</span>
            <textarea class="form-control" aria-label="With textarea" name="description"></textarea> -->
            </div>
            <!-- size -->
            <div class="mb-3"> 
            <label for="size" class="form-label">Size</label>
                <select name="size" class="form-control" value="<?=$row["size"]?>"> 
                <!-- if select nothing > value is null -->
                    <option value="null" > -- </option>
                    <option value="small" > small </option>
                    <option value="medium" > medium </option>
                    <option value="large" > large </option>
                </select>
            </div>
            <!-- Gender -->
            <div class="mb-3"> 
            <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-control" value="<?=$row["gender"]?>"> 
                <!-- if select nothing > value is null -->
                    <option value="null" > -- </option>
                    <option value="other" > other </option>
                    <option value="female" > female </option>
                    <option value="male" > male </option>       
                 </select>
            </div>
            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control"  id="location"  aria-describedby="location"  name="location" value="<?=$row["location"]?>">
            </div>
            <!-- Vaccinated -->
            <div class="mb-3"> 
            <label for="vaccinated" class="form-label">Vaccinated</label>
                <select name="vaccinated" class="form-control" value="<?=$row["vaccinated"]?>"> 
                <option value="null" > -- </option>
                    <option value="1" > yes </option>
                    <option value="2" > no </option>
                </select>
            </div>
            <!-- Picture -->
           <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
            <button name="update" type="submit" class="btn btn-primary">Update product</button>
            <a href="index.php" class="btn btn-warning">Back to home page</a>
        </form>
    </div>

<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>