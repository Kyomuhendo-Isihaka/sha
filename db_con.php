<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "isihaka";

 try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
    // echo"Connected";

 }catch(PDOException $e){
    echo"connection Failed" .$e->getMessage();
 }