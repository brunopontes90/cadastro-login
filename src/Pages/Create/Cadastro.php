<?php
    session_start();
    ob_start(); //LIMPAR O BUFFER DE SAIDA
    include_once '../../Conection/Conection.php';
    $connect = new ConnectDatabase();
    $connectDatabase = $connect->Connect();
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css" href="../../../index.css" />
    <title>Cadastrar</title>
</head>
<body>
    <h1 class="titulo-cadastro" >Cadastrar</h1>
    <?php
        // RECEBE OS DADOS DO FORMULARIO
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // VERIFICA SE O USUARIO CLICOU NO BOTÃO
       if(!empty($dados['CadUser'])){
            $row_user = $connect->CreateQuery($dados);
        }
    ?>
    <form name='cad-user' method='POST' action='' class="form-login">
        <div class="div-name">
            <label class="label">Nome:</label>
            <input class="input" type="text" name="nome" id="nome" placeholder="Nome Completo" required/>
        </div>
        <div class="div-email">
            <label class="label">Email:</label>
            <input class="input" type="email" name="email" id="email" placeholder="Digite seu email" required/>
        </div>
        <div class="div-senha">
            <label class="label">Senha:</label>
            <input class="input" type="pass" name="senha" id="senha" placeholder="Digite sua senha" required/>
        </div>

        <input class="btn-cadastrar" type="submit" value="Cadastrar" name="CadUser" />
        <a href="../../../index_tpl.php">Voltar</a>
    </form>
</body>
</html>