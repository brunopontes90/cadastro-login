<?php
    session_start();
    include_once '../../Conection/Conection.php';
    $resul = array();
    $delete_user =  "DELETE FROM user WHERE id = :id";
    $result_delete_user = $conn->prepare($delete_user);
    $result_delete_user->bindParam(':id', $_GET['id']);
    
    if ($result_delete_user->execute()) {
        $_SESSION['msg'] =  "<p style='color: #01DF01;'>Usuario deletado com sucesso!</p>";
        header("Location: ../List/Listar.php");
    }else{
        $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuario não foi deletado com sucesso!</p>";
    }
    