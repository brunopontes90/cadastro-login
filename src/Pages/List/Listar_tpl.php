<?php
    session_start();
    include_once '../../Conection/Conection.php';
    $connect = new ConnectDatabase();
    $connectDatabase = $connect->Connect();
    $queySelect = $connect->SelectQuery();
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
    <a href="../../../index_tpl.php">Sair</a>
    <h1 class="titulo-listagem">Lista de Usuarios</h1>
    <?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
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
            <?php foreach($queySelect as $row) {?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$row['email']?></td>
                    <td>
                        <a href="../Edit/Editar.php?id=<?=$row['id']?>" class="btn-edit fas fa-edit">Editar</a>
                        <a href="../Delete/Deletar.php?id=<?=$row['id']?>" class="btn-delete fas fa-trash-alt">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>