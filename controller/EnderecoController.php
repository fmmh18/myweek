<?php

include_once "../model/EnderecoModel.php";

class EnderecoController
{
    function adicionarEndereco($obj){
        $endereco = new EnderecoModel();
        return $endereco->adicionarEndereco($obj);

    }

    function editarEndereco($obj){
        $endereco = new EnderecoModel();
        return $endereco->editarEndereco($obj);
    }

    function retornarEnderecoUsuario($id)
    {
        $endereco = new EnderecoModel();

        return $endereco->retornarEnderecoUsuario($id);
    }

    function excluirEndereco($id)
    {
        $endereco = new EnderecoModel();
        return $endereco->deletarEndereco($id);
    }
}