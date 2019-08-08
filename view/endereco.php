<?php

include_once "../controller/EnderecoController.php";

$enderecos = new EnderecoController();


$obj = array('logradouro'=>$_POST['logradouro'],
             'complemento'=>$_POST['complemento'],
             'numero'=>$_POST['numero'],
             'bairro'=>$_POST['bairro'],
             'localidade'=>$_POST['localidade'],
             'uf'=>$_POST['uf'],
             'cep'=>$_POST['cep'],
             'usuarioid'=>$_POST['usuarioid']
);
if($_POST['acao'] == "salvar"){
    echo $enderecos->adicionarEndereco($obj);
}else if($_POST['acao'] == 'editar'){
    echo $enderecos->editarEndereco($obj);
}