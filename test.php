<?php 
    require_once 'config.php';

    function generateRandomString($nbLetters){
        $randString="";
        $charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for($i=0; $i<$nbLetters; $i++){
           $randInt=rand(0,61);
            $randChar=$charUniverse[$randInt];
            $randString=$randString.$randChar;
        }
        return $randString;
    }

    $db = new Database();
    $salt = generateRandomString(10);

    echo $salt;
?>