<?php
session_start(); //Start Session for user

   require_once "db_connection.php" ; //Connection to DB

if(isset($_SESSION["adm"])){ //if there is a session adm i redirect him
header("Location: dashboard.php");
}
if(isset($_SESSION["user"])){ //if there is a session user i redirect him
    header("Location: home.php");
    }


   $email=$passError=$emailError=""; //Declare Variables
   $error= false;

   function cleanInputs($input){
    $data = trim($input); // removing extra spaces, tabs, newlines out of the string
    $data = strip_tags($data); // removing tags from the string
    $data = htmlspecialchars($data); // converting special characters to HTML entities, something like "<" and ">", it will be replaced by "&lt;" and "&gt";

     return $data;
}

if(isset ($_POST["login"])){
    $email = cleanInputs($_POST["email"]);
    $password = $_POST[ "password"];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // Validation for email
        $error = true ;
        $emailError = "Please enter a valid email address" ;
    }

     if (empty ($password)) {      // validation for the password
        $error = true ;
        $passError = "Password can't be empty!";
    }

    if(!$error){ // if there is no error > inserted to database > hashing the password 
       $password = hash( "sha256", $password);

       //to log-in i want to select specific entry from DB!! > Query
       $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'" ; //looking for entry with same email + password 
       $result = mysqli_query($connect, $sql); //run the Query
       $row = mysqli_fetch_assoc($result); //fetch the data if there is a record match > then all the information is in this variable

       if (mysqli_num_rows($result) == 1){ //if there is 1 result and only 1
        if ($row["status"] == "adm" ){ // if the status in the database of that user is admin
            $_SESSION["adm"] = $row["id"]; // here a new session will be created with the name adm and it will save the user id
            header( "Location: dashboard.php" ); // admins will be redirected to dashboard page
        } else  {
            $_SESSION["user"] = $row["id"]; // here a new session will be created with the name user and it will save the user id
            header( "Location: home.php" ); // users will be redirected to home page
        } // auch Verwendung von if/elseif möglich, auch Reihnfolge nicht wichtig adm > user oder user > adm

} else  {
    echo   "<div class='alert alert-danger'>
           <p> Wrong credentials, please try again ...</p>
         </div>" ;
}
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Login page </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Login page </h1>
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>" >
                    <span class="text-danger"><?= $emailError ?></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?= $passError ?></span>
                </div>
                <button name="login" type="submit" class="btn btn-primary">Login</button>
             
                <span>you don't have an account? <a href="register.php">register here </a></span>
            </form>
        </div>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>