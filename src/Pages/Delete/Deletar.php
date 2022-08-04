<?php
    session_start();
    include_once '../../Conection/Conection.php';
    $connect = new ConnectDatabase();
    $connectDatabase = $connect->Connect();
    $row_user = $connect->DeleteQuery($_GET['id']);