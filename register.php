<?php 

require_once "db_connection.php";
require_once "file_upload.php";

session_start();

if(isset($_SESSION["adm"])){ //if there is a session adm i redirect him
header("Location: dashboard.php");
}
if(isset($_SESSION["user"])){ //if there is a session user i redirect him
    header("Location: home.php");
    }

$error= false;

$fname = $lname = $email= $phone= $address= "";
$fnameError= $lnameError= $addressError= $phoneError= $emailError= $passError="";

//Function for setting Data Inputs
function cleanInput($param){
$data= trim($param);
$data= strip_tags($data);
$data= htmlspecialchars($data);

return $data;
}

//Validation of Data
if (isset($_POST["sign-up"])){
    $fname= cleanInput($_POST["fname"]);
    $lname= cleanInput($_POST["lname"]);
    $email= cleanInput($_POST["email"]);
    $password= $_POST["password"];
    $address= cleanInput($_POST["address"]);
    $phone= cleanInput($_POST["phone"]);
    $picture= fileUpload($_FILES["picture"]);

    if(empty($fname)){
    $error=true;
    $fnameError="Please, enter your first name";
}elseif(strlen($fname)<3){
$error=true;
$fnameError="Name must have at least 3 characters";
}elseif(!preg_match("/^[a-zA-Z\s]+$/", $fname)){
    $error= true;
    $fnameError="Name must contain only letters and spaces";
};

if(empty($lname)){ //check if empty
    $error=true;
    $lnameError="Please, enter your last name";
}elseif(strlen($lname)<3){ //check value must be more than 3 characters
$error=true;
$lnameError="Name must have at least 3 characters";
}elseif(!preg_match("/^[a-zA-Z\s]+$/", $lname)){ //check for special Characters
    $error= true;
    $lnameError="Name must contain only letters and spaces";
};

if(empty($address)){
    $error=true;
    $addressError="Address can not be empty";
};

if(empty($phone)){ //check if empty
    $error=true;
    $phoneError="Please, enter your phone number";
}elseif(strlen($phone)<3){ //check value must be more than 3 characters
$error=true;
$phoneError="Number must have at least 3 characters";
}elseif(!preg_match("/^[0-9]*$/", $phone)){ //check for special Characters
    $error= true;
    $phoneError="Number must contain only numbers";
};

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error= true;
    $emailError="Please enter a valid email address";
}else{
    $query= "SELECT email FROM users WHERE email = '$email'"; //Query if Email exists
    $result=mysqli_query($connect, $query);
    if(mysqli_num_rows($result)!=0){ //check if i get 1 result
        $error=true;
        $emailError="Provided Email is already in use";
    }
};

if(empty($password)){
    $error=true;
    $passError="Password can not be empty";
}elseif(strlen($password)<6){
    $error=true;
    $passError="Password must have at least 6 characters";
};

if(!$error){ //if error is not true we are ready to go + hash the password
$password= hash("sha256", $password); //Format Vorgabe für hash: "sha256", $password zu verbergende Variable
$sql= //Query to insert data (copy Insert from MySQL) 
"INSERT INTO `users`(`first_name`, `last_name`, `password`, `address`, `phone`, `email`, `picture`) VALUES ('$fname','$lname','$password','$address', '$phone','$email','$picture[0]')"; //$picture  + Index of 0 because index of 1 is the message in file_upload.php

if(mysqli_query($connect, $sql)){ //if my query worked fine than...
    echo "<div class='alert alert-success'><p> New account has been created, $picture[1]</p></div>";
}else{
    echo "<div class='alert alert-danger'><p> Something went wrong, please try again later...</p></div>";
}
} 


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin="anonymous">
</head>
<body>
    
<!-- Form -->
    <div class="container mt-5">
       <h2>Register</h2>
       <form method="POST" enctype= "multipart/form-data">
           <!-- first name -->
       <div class="mb-3 mt-3">
               <label for="fname" class= "form-label">First Name</label>
               <input  type="text" class="form-control" id="fname" aria-describedby="fname" name="fname" placeholder="First Name" value="<?=$fname?>">
<span class="text-danger"><?= $fnameError?></span>
            </div>
<!-- last name -->
<div class="mb-3 mt-3">
               <label for="lname" class= "form-label">Last Name</label>
               <input  type="text" class="form-control" id="lname" aria-describedby="lname" 

name="lname" placeholder="Last Name" value="<?=$lname?>">
<span class="text-danger"><?= $lnameError?></span>
            </div>
             <!-- address -->
       <div class="mb-3 mt-3">
               <label for="address" class= "form-label">Address</label>
               <input  type="text" class="form-control" id="address" aria-describedby="address" name="address" placeholder="Street, Nr" value="<?=$address?>">
               <span class="text-danger"><?= $addressError?></span>
            </div>
<!-- phone -->
<div class="mb-3 mt-3">
               <label for="phone" class= "form-label">Phone Number</label>
               <input  type="text" class="form-control" id="phone" aria-describedby="phone" 

name="phone" placeholder="xxxxxx" value="<?=$phone?>">
<span class="text-danger"><?= $phoneError?></span>
            </div>
           <!-- picture -->
           <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control"  id="email"  aria-describedby="email"  name="email" placeholder="Email address" value="<?=$email?>">
                <span class="text-danger"><?= $emailError?></span>

            </div>
            <!-- password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control"  id="password"  aria-describedby="password"  name="password">
                <span class="text-danger"><?= $passError?></span>

            </div>
            <!-- submit -->
            <button name="sign-up" type="submit" class="btn btn-primary">Create account</button>
            
            <span>you have an account already? </span><a href="login.php">sign in here</a>
        </form>
    </div>

<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>