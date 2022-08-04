<?php

class ConnectDatabase{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "cadastro_login";
    private $port = 3306;
    var $conn;

    public function Connect(){
        try {
            $this->conn =  new PDO("mysql:host=$this->host;port=$this->port;dbname=" . $this->dbname, $this->user, $this->pass);
        } catch(PDOException $objErro){
            echo 'SGBD Indisponivel: ' . $objErro->getMessage();
            exit(); 
        }
    }

    public function Login($dados){
        $query = $this->conn->prepare("SELECT id, nome FROM user WHERE email = :email AND senha = :senha");
        $query->bindParam(':email', $dados['email']);
        $query->bindParam(':senha', $dados['senha']);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_CLASS);

        if(count($result) == 1){
            session_start();
            $_SESSION['email'] = $result[0]->nome;
            $_SESSION['id'] = $result[0]->id;
            return true;
        }else{
            return false;
        }
    }

    public function SelectQuery(){
        $sql = "SELECT * FROM user";
        return $this->conn->query($sql)->fetchAll();
    }

    public function CreateQuery($dados){
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
            $query_user = $this->conn->prepare("INSERT INTO user (nome, email, senha) VALUES (:nome, :email, :senha)");
            $query_user->bindParam(':nome', $dados['nome']);
            $query_user->bindParam(':email', $dados['email']);
            $query_user->bindParam(':senha', $dados['senha']);
            $query_user->execute();

            if($query_user->rowCount()){
                unset($dados);
                $_SESSION['msg'] = "<p style='color: green ;'>Usuario cadastrado com sucesso!</p>";
                header("Location: ../List/Listar_tpl.php");
            }else{
                echo "<p style='color: red ;'>ERRO: tente novamente</p>";
            }
        }
    }

    public function EditQuery($id){

        if(empty($id)){
            return null;
        }

        $query_edit_user = "SELECT id, nome, email, senha FROM user WHERE id = $id LIMIT 1";
        $result_edit_user =  $this->conn->prepare($query_edit_user);
        $result_edit_user->execute();

        if(($result_edit_user) AND ($result_edit_user->rowCount() != 0)){
            return $result_edit_user->fetch(PDO::FETCH_ASSOC); // LE O RESULTADO
        }else{
            return null;
        }
    }

    public function UpdateQuery($dados, $id){
        $empty_input = false;
        $dados = array_map('trim', $dados);

        // verifica se tem campoo vazio 
        if(in_array("", $dados)){
            $empty_input = true;
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
            $edit_user = $this->conn->prepare($query_update);
            $edit_user->bindParam(':nome', $dados['nome']);
            $edit_user->bindParam(':email', $dados['email']);
            $edit_user->bindParam(':senha', $dados['senha']);
            $edit_user->bindParam(':id', $id);

            var_dump($query_update);

            if($edit_user->execute()){
                $_SESSION['msg'] = "<p style='color: #01DF01;'>Usuario editado com sucesso!</p>";
                header("Location: ../List/Listar_tpl.php");
            }else{
                $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuario não editado com sucesso!</p>";
                
            }
        }
    }

    public function DeleteQuery($id){
        $delete_user =  "DELETE FROM user WHERE id = :id";
        $result_delete_user = $this->conn->prepare($delete_user);
        $result_delete_user->bindParam(':id', $id);
        
        if ($result_delete_user->execute()) {
            $_SESSION['msg'] =  "<p style='color: #01DF01;'>Usuario deletado com sucesso!</p>";
            header("Location: ../List/Listar_tpl.php");
        }else{
            $_SESSION['msg'] = "<p style='color: #FF0000;'>Erro; Usuario não foi deletado com sucesso!</p>";
        }
        }
}