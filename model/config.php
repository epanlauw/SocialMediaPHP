<?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sosmed";

    try{
        $db = new mysqli($host, $username, $password,$dbname);
    }catch(mysqli_sql_exception $e){

    }
?>