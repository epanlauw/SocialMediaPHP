<?php 
    class Database{
       var $root = "localhost";
       var $username = "root";
       var $password = "";
       var $dbname = "sosmed";

       function __construct(){
           $this->koneksi = mysqli_connect($this->root, $this->username, $this->password, $this->dbname);
           if(mysqli_connect_errno()){
               echo "Koneksi database gagal: " . mysqli_connect_error();
           }
       }
    }
?>