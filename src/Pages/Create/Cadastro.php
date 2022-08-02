<?php
    session_start();
    ob_start(); //LIMPAR O BUFFER DE SAIDA
    include_once '../../Conection/Conection.php';
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
            $empty_input = false;
            $dados = array_map('trim', $dados);

            if(in_array("", $dados)){
                $empty_input = true;
                echo "<p style='color: red ;'>ERRO: Necessario preencher todos os campos!</p>";

            // VERIFICA SE É UM EMAIL
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: red ;'>ERRO: Preencher com email válido!</p>";
            }

            // VERIFICA SE TEM DADOS NO INPUT, SE TIVER, ENVIA OS DADOS
            if(!$empty_input){
                $query_user = $conn->prepare("INSERT INTO user (nome, email, senha) VALUES (:nome, :email, :senha)");
                $query_user->bindParam(':nome', $_POST['nome']);
                $query_user->bindParam(':email', $_POST['email']);
                $query_user->bindParam(':senha', $_POST['senha']);
                $query_user->execute();

                if($query_user->rowCount()){
                    unset($dados);
                    $_SESSION['msg'] = "<p style='color: green ;'>Usuario cadastrado com sucesso!</p>";
                    header("Location: ../List/Listar.php");
                }else{
                    echo "<p style='color: red ;'>ERRO: tente novamente</p>";
                }
            }
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
        <a href="../../../index.php">Voltar</a>
    </form>
</body>
</html>