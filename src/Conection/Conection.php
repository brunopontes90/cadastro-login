<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cadastro_login";
$port = 3306;

try {
    $conn =  new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
} catch(PDOException $objErro){
    echo 'SGBD Indisponivel: ' . $objErro->getMessage();
    exit(); 
}