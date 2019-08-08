<?php

include_once "../model/UsuarioModel.php";

class UsuarioController
{
    function adicionarUsuarios($obj){
        $usuario = new UsuarioModel();
        return $usuario->adicionarUsuario($obj);
        header('Location:listar.php');
    }

    function editarUsuarios($obj){
        $usuario = new UsuarioModel();
        return $usuario->editarUsuario($obj);
    }

    function excluirUsuarios($id){
        $usuario = new UsuarioModel();
        return $usuario->deletarUsuario($id);
    }

    function listarUsuarios()
    {
        $usuario = new UsuarioModel();
        return $usuario->listarUsuario();
    }

    function retornarUsuario($id)
    {

        $usuario = new UsuarioModel();

        return $usuario->retornarUsuario($id);
    }

}