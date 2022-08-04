<?php
    session_start();
    ob_start(); //LIMPAR O BUFFER DE SAIDA QUANDO REDIRECIONADO
    include_once '../../Conection/Conection.php';
    $id= filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $connect = new ConnectDatabase();
    $connectDatabase = $connect->Connect();
    $row_user = $connect->EditQuery($id);

    if($row_user == null){
        $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuário não encontrado</p>";
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css" href="Editar.css" />
    <title>Editar</title>
</head>
<body>
    <h1 class="titulo-editar">Editar Usuario</h1>
    <?php
        // RECEBER OS DADOS DO FORMULARIO
        $dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // VERIFICA SE O USER CLICOU NO BOTAO
        if(!empty($dados['EditUser'])){
            $connect->UpdateQuery($dados, $id);
        }
    ?>
    <form id="edit-usuario" class="form-login" method="POST" action="">
        <div class="div-name">
            <label class="label">Nome:</label>
            <input class="input" type="text" name="nome" id="nome" value="<?=$row_user['nome']?>" placeholder="Nome Completo" required/>
        </div>
        <div class="div-email">
            <label class="label">Email:</label>
            <input class="input" type="email" name="email" id="email" value="<?=$row_user['email'] ?>" placeholder="Digite seu email" required/>
        </div>
        <div class="div-senha">
            <label class="label">Senha:</label>
            <input class="input" type="pass" name="senha" id="senha" value="<?=$row_user['senha'] ?>" placeholder="Digite sua senha" required/>
        </div>
        <a href="../List/Listar_tpl.php" class="btn-cancelar">Cancelar</a>
        <input class="btn-salvar" type="submit" value="Salvar" name="EditUser" />
    </form>
</body>
</html>