<?php

class Conection{
    private $pdo;

    public function __construct($dbname, $host, $user, $pass)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "ERRO COM O PDO : ".$e->getMessage();
        } catch (Exception $e) {
            echo "ERRO GENERICO : ".$e->getMessage();
        }

       
    }


// CADASTRA UM USUARIO NO BANCO VERIFICANDO
// SE O E-MAIL NÃO ESTA REPETIDO
    public function cadastrar($nome , $telefone, $email){
        //VERIFICAÇÃO DO E-MAIL
        $cmd = $this->pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        if($cmd->rowCount() > 0){
            return false;
        }else{
            // INSERÇÃO DE USUARIO NO BANCO
            $cmd = $this->pdo->prepare("INSERT INTO usuario(nome, tel, email)VALUES(:n, :t, :e)");

            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);

            $cmd->execute();
            return true;
        }
    }

    // BUSCA TODOS OS USUARIOS CADASTRADOS NO BANCO 
    // PARA EXIBIR NA TABELA
    public function buscar_dados(){
        $res = [];
        $cmd = $this->pdo->query("SELECT * FROM usuario ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function deletar($id){
        $cmd = $this->pdo->prepare("DELETE FROM usuario WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();     
    }

    public function buscar_editar($id){
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editar($edit, $nome, $telefone, $email){
        $cmd = $this->pdo->prepare("UPDATE usuario SET nome = :n,
        tel = :t, email = :e WHERE id = :id");

        $cmd->bindValue(":id", $edit);
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->execute();
    }

















}// FINAL DA CLASSE CONECTION





?>