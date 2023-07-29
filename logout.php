<?php

session_start();
if(isset($_GET["logout"])){
    unset($_SESSION["user"]); //$_SESSION["user"]="" to remove the value
    unset($_SESSION["adm"]);
session_unset(); // means to unset all sessions > short Way insted of unset one by one = to remove values
session_destroy(); // to kill session 
header("Location: login.php "); //send back to...
}