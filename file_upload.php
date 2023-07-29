<?php

function fileUpload($pic, $source="user"){
    if($pic["error"]==4){ //checking if file has been selected, 0 if choose a file, 4 if not
        $pictureName= "Avatar.jpg"; //file name will be avatar.png

        if($source == "entry"){
            $pictureName="Placeholder.png"; //default picture for product
        }
        $message= "No picture has been choosen, add one later.";
    }else{
        $checkIfImage= getimagesize($pic["tmp_name"]); //checking if you selected an image, return false if not
        $message= $checkIfImage ? "Ok" : "Not an Image";
        }

    if($message == "Ok"){
        $ext= strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION)); //taking extension data from img
        $pictureName= uniqid("").".".$ext; //changing name of img
        $destination= "img/{$pictureName}"; //where file will be saved

        if($source== "entry"){
            $destination="../img/{$pictureName}";
        }
        move_uploaded_file($pic["tmp_name"], $destination); //moving file to pic folder
    }elseif($message == "Not an Image"){
        $pictureName= "Avatar.jpg"; //file name will be avatar.jpg
        $message= "The file that you chose is not an Image.";
    }

    return [$pictureName, $message]; //returning name of pic + message
}