<?php
    session_start();
    include_once './src/Conection/Conection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css" href="index.css" />
    <title>Cadastrar</title>
</head>
<body>
    <a href="./src/pages/List/listar.php">Listagem</a>
    <h1 class="titulo-cadastro" >Login</h1>
    <?php
        if(isset($_POST['entrar'])){
            header("Location: ./src/pages/List/listar.php");

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

                header("Location: ./src/pages/List/listar.php");
            }else{
                echo "<p style='color: red ;'>ERRO: Credenciais invalidas, tente novamente</p>";
                header("Location: index.php");
            }
        }else{}
    ?>
    <form name='cad-user' method='POST' action='' class="form-login">
        <div class="div-email">
            <label class="label">Email:</label>
            <input class="input" type="email" name="email" id="email" placeholder="Digite seu email" required/>
        </div>
        <div class="div-senha">
            <label class="label">Senha:</label>
            <input class="input" type="pass" name="senha" id="senha" placeholder="Digite sua senha" required/>
        </div>

        <input class="btn-cadastrar" type="submit" value="Entrar" name="entrar" />
        <a href="./src/Pages/Create/Cadastro.php" class="btn-teste">Não possuo cadastro</a>
    </form>
</body>
</html>