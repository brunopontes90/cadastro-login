<?php
    session_start();
    ob_start(); //LIMPAR O BUFFER DE SAIDA
    include_once './src/Conection/Conection.php';
    $connect = new ConnectDatabase();
    $connectDatabase = $connect->Connect();

    if(isset($_POST['entrar'])){
        $dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $login = $connect->Login($dados);

        if($login){
            header("Location: ./src/pages/List/Listar_tpl.php");
        }else{
            $_SESSION['msg'] =  "<p style='color: red ;'>ERRO: Credenciais invalidas, tente novamente</p>";
            header("Location: ./index_tpl.php");
        }
    }