<?php

include_once "Conexao.php";

class EnderecoModel extends Conexao
{
    public function adicionarEndereco($obj)
    {
        $sql = "INSERT INTO endereco(logradouro,complemento,bairro,localidade,uf,cep,usuarioid,numero,flg) VALUES (:logradouro,:complemento,:bairro,:localidade,:uf,:cep,:usuarioid,:numero,:flg)";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('logradouro',  $obj['logradouro']);
        $statement->bindValue('complemento', $obj['complemento']);
        $statement->bindValue('bairro' , $obj['bairro']);
        $statement->bindValue('localidade' , $obj['localidade']);
        $statement->bindValue('uf' , $obj['uf']);
        $statement->bindValue('cep' , $obj['cep']);
        $statement->bindValue('usuarioid' , $obj['usuarioid']);
        $statement->bindValue('numero' , $obj['numero']);
        $statement->bindValue('flg' , 1);
        $statement->execute();
        return $statement->rowCount();
    }

    public function editarEndereco($obj)
    {
        $sql = "UPDATE endereco SET logradouro = :logradouro, complemento = :complemento,bairro = :bairro, localidade = :localidade, uf =:uf, cep = :cep, usuarioid = :usuarioid, flg = :flg WHERE id = :id ";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('logradouro',  $obj['logradouro']);
        $statement->bindValue('complemento', $obj['complemento']);
        $statement->bindValue('bairro' , $obj['bairro']);
        $statement->bindValue('localidade' , $obj['localidade']);
        $statement->bindValue('uf' , $obj['uf']);
        $statement->bindValue('cep' , $obj['cep']);
        $statement->bindValue('usuarioid' , $obj['usuarioid']);
        $statement->bindValue('flg' , $obj['flg']);
        $statement->bindValue('id' , $obj['id']);
        return$statement->execute();
    }

    public function deletarEndereco($id){
        $sql =  "DELETE FROM endereco WHERE usuarioid = :usuarioid";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('usuarioid',$id);
        $statement->execute();
    }

    public function retornarEnderecoUsuario($id)
    {
        $sql =  "SELECT * FROM endereco WHERE usuarioid = :usuarioid";
        $statement = Conexao::prepare($sql);
        $statement->bindValue('usuarioid',$id);
        $statement->execute();
        return $statement->fetchAll();
    }

}