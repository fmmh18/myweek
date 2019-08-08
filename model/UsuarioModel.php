<?php
include_once "Conexao.php";

class UsuarioModel extends Conexao
{

    public function adicionarUsuario($obj)
    {
        $sql = "INSERT INTO usuario(nome,email,telefone,flg) VALUES (:nome,:email,:telefone,:flg)";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('nome',  $obj['nome']);
        $statement->bindValue('email', $obj['email']);
        $statement->bindValue('telefone' , $obj['telefone']);
        $statement->bindValue('flg' , 1);
        return $statement->execute();

    }

    public function editarUsuario($obj)
    {
        $sql = "UPDATE usuario SET nome = :nome, email = :email,telefone = :telefone, flg = :flg WHERE id = :id ";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('nome',  $obj['nome']);
        $statement->bindValue('email', $obj['email']);
        $statement->bindValue('telefone' , $obj['telefone']);
        $statement->bindValue('flg' , $obj['flg']);
        $statement->bindValue('id' , $obj['id']);
        return$statement->execute();
    }

    public function deletarUsuario($id){
        $sql =  "DELETE FROM usuario WHERE id = :id";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('id',$id);
        $statement->execute();
    }

    public function listarUsuario(){
        $sql = "SELECT * FROM usuario";
        $statement = Conexao::prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function retornarUsuario($id)
    {
        $sql =  "SELECT * FROM usuario WHERE id = :id";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetchAll();
    }

}