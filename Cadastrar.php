<?php
    include_once './src/Conection/Conection.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
</head>
<body>
    <h1>Cadastrar</h1>
    <?php
        $dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($dados["CadUser"])){
            //var_dump($dados);
            $query_user = "INSER INTO user (nome, email) VALUES ('" . $dados["nome"] . "', '" . $dados["email"] . "')";
            $cad_user = $conn->prepare($query_user);
            $cad_user->exec();
        }
    ?>
    <form name='cad-user' method='POST' action=''>
        <div>
            <label>Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome Completo" />
        </div>
       <div>
            <label>Email:</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email" />
        </div>

        <input type="submit" value="Cadastrar" name="CadUser" />
    </form>
</body>
</html>