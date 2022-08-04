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
    <h1 class="titulo-cadastro" >Login</h1>
    <?php
         if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <form name='cad-user' method='POST' action='index.php' class="form-login">
        <div class="div-email">
            <label class="label">Email:</label>
            <input class="input" type="email" name="email" id="email" placeholder="Digite seu email" required/>
        </div>
        <div class="div-senha">
            <label class="label">Senha:</label>
            <input class="input" type="pass" name="senha" id="senha" placeholder="Digite sua senha" required/>
        </div>

        <input class="btn-cadastrar" type="submit" value="Entrar" name="entrar" />
        <a href="./src/Pages/Create/Cadastro.php">Não possuo cadastro</a>
    </form>
</body>
</html>