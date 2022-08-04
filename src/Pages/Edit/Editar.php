<?php
    session_start();
    ob_start(); //LIMPAR O BUFFER DE SAIDA QUANDO REDIRECIONADO
    include_once '../../Conection/Conection.php';

    // PEGA O ID DO CAMPO
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(empty($id)){
        $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuário não encontrado</p>";
        header("Location: index.php");
        exit();
    }

    $query_edit_user = "SELECT id, nome, email, senha FROM user WHERE id = $id LIMIT 1";
    $result_edit_user =  $conn->prepare($query_edit_user);
    $result_edit_user->execute();

    if(($result_edit_user) AND ($result_edit_user->rowCount() != 0)){
        $row_user = $result_edit_user->fetch(PDO::FETCH_ASSOC); // LE O RESULTADO
    }else{
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
            $empty_input = false;
            $dados = array_map('trim', $dados);

            // verifica se tem campoo vazio 
            if(in_array("", $dados)){
                $$empty_input = true;
                echo "<p style='color: #FF0000;'>Erro; Necessario preencher todos os campos!</p>";

            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: red ;'>ERRO: Preencher com email válido!</p>";
            }
            
            // VERIFICA SE TEM ESTRUTURA DE EMAIL
            if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: red ;'>ERRO: Preencher com email válido!</p>";
            }

            if(!$empty_input){
                $query_update = "UPDATE user SET nome=:nome, email=:email, senha=:senha WHERE id=:id";
                $edit_user = $conn->prepare($query_update);
                $edit_user->bindParam(':nome', $_POST['nome']);
                $edit_user->bindParam(':email', $_POST['email']);
                $edit_user->bindParam(':senha', $_POST['senha']);
                $edit_user->bindParam(':id', $id);

                if($edit_user->execute()){
                    $_SESSION['msg'] = "<p style='color: #01DF01;'>Usuario editado com sucesso!</p>";
                    header("Location: ../List/Listar_tpl.php");
                }else{
                    $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuario não editado com sucesso!</p>";
                    
                }
            }
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