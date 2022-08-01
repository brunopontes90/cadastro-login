<?php
    include_once '../../Conection/Conection.php';
    $result = array();
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css" href="Listar.css" />
    <script src="https://kit.fontawesome.com/8455a3d02b.js" crossorigin="anonymous"></script>
    <title>Listagem</title>
</head>
<body>
    <a href="../../../index.php">Cadastrar</a>
    <h1 class="titulo-listagem">Listagem</h1>
    <table class="table-list">
        <tbody table=1>
            <td>
                <lable>Id</lable>
            </td>
            <td>
                <lable>Nome</lable>
            </td>
            <td>
                <lable>Email</lable>
            </td>
            <td>
                <lable>Ação</lable>
            </td>
            <?php foreach($result as $row) {?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$row['email']?></td>
                    <td>
                        <a href="/#/#?id=<?=$row['id']?>" class="btn-edit fas fa-edit">Editar</a>
                        <a href="/#/#?id=<?=$row['id']?>" class="btn-delete fas fa-trash-alt">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>