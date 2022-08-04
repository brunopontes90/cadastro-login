<?php

// if(isset($_SESSION['login'])){
    //     header("Location: ./src/pages/List/Listar_tpl.php");

    // }elseif(isset($_POST['entrar'])){
        
    //     $login = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    //     $senha = $_POST['senha'];
    //     $query = $conn->prepare("SELECT id, nome FROM user WHERE email = :email AND senha = :senha");
    //     $query->bindParam(':email', $_POST['login']);
    //     $query->bindParam(':senha', $_POST['senha']);
    //     $query->execute();

    //     var_dump($senha);
    // }else{
    //     echo "<p style='color: red ;'>ERRO: Credenciais invalidas, tente novamente</p>";
    //     header("Location: index.php");
    // }

if(isset($_POST['entrar'])){
            
    header("Location: ./src/pages/List/Listar_tpl.php");

}elseif(isset($_POST['entrar'])){
    $query = $conn->prepare("SELECT id, nome FROM user WHERE email = :email AND senha = :senha");
    $query->bindParam(':email', $_POST['login']);
    $query->bindParam(':senha', $_POST['senha']);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_CLASS);

    if(count($result) == 1){
        session_start();
        $_SESSION['login'] = $result[0]->nome;
        $_SESSION['id'] = $result[0]->id;

        header("Location: ./src/pages/List/Listar_tpl.php");
    }else{
        echo "<p style='color: red ;'>ERRO: Credenciais invalidas, tente novamente</p>";
        header("Location: index.php");
    }
}