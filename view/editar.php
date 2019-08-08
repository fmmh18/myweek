<?

include_once "../controller/UsuarioController.php";
include_once "../controller/EnderecoController.php";

$usuario = new UsuarioController();

$endereco = new EnderecoController();

$user = $usuario->retornarUsuario($_GET['id']);

$enderecos = $endereco->retornarEnderecoUsuario($_GET['id']);

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>MyWeek</title>
</head>
<body>
<?
if(!empty($_POST)){

    $obj = array('nome'=>$_POST['nome'],'email'=>$_POST['email'],'telefone'=>$_POST['telefone'],'id'=>$_GET['id']);
    $insert = $usuario->editarUsuarios($obj);
    if($insert == true){
        ?>
        <script>
            toastr.success("Registro alterado.");
        </script>

    <?  }else{ ?>
        <script>
            toastr.danger("Registro não alterado.");
        </script>
        <?
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">@</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12">
            <br/>
            <a href="javascript: window.history.back()" class="btn btn-primary">Voltar</a>
            <br/><br/>
            <form method="post" >
                <div class="form-group">
                    <label for="nome"><b>Nome<sup>(*)</sup></b></label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo(*)" value="<?php echo $user[0]->nome; ?>" >
                </div>
                <div class="form-group">
                    <label for="email"><b>E-mail<sup>(*)</sup></b></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-mail(*)" value="<?php echo $user[0]->email; ?>" >
                </div>
                <div class="form-group">
                    <label for="telefone"><b>Telefone<sup>(*)</sup></b></label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone(*)" value="<?php echo $user[0]->telefone; ?>" >
                </div>
                <div class="form-group">
                    <label for="selectQtdEndereco"><b>Inserir Endereço</b></label>

                </div>
                <div class="form-group">
                    <label for="cep"><b>Digite o CEP</b></label>
                    <input type="text" maxlength="8" class="form-control" id="cep"  placeholder="Digite o CEP">
                </div>
                <div id="inputs">
                    <table class="table-bordered table-striped table" id="minhaTabela">
                        <thead>
                        <tr>
                            <td><b>Endereço</b></td>
                            <td><b>Complemento</b></td>
                            <td><b>Número</b></td>
                            <td><b>Bairro</b></td>
                            <td><b>Cidade</b></td>
                            <td><b>UF</b></td>
                            <td><b>CEP</b></td>
                            <td><b>&nbsp;</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <? if(count($enderecos) > 0){

                        foreach($enderecos as $end) {
                            echo "<tr>";
                            echo "<td>" . $end->logradouro."</td>";
                            echo "<td>" . $end->complemento."</td>";
                            echo "<td>" . $end->numero."</td>";
                            echo "<td>" . $end->bairro."</td>";
                            echo "<td>" . $end->localidade."</td>";
                            echo "<td>" . $end->uf."</td>";
                            echo "<td>" . $end->cep."</td>";
                            echo "<td><img src='../assets/images/edit.png' class='btnEditar'/> <img src='../assets/images/delete.png' class='btnExcluir'/></td>";
                            echo "</tr>";
                        }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" value="Salvar" name="acao"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

    $( document ).ready(function() {
        $(".btnEditar").bind("click", Editar);
        $(".btnExcluir").bind("click", Excluir);
    });




    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //   var appending = '<table class="table table-striped table-bordered" id="tabelaEndereco">';

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback", function(dados) {

                    if (!("erro" in dados)) {

                        $("#minhaTabela tbody").append(
                            '<tr>'+
                            '<td><input type="text" value="'+ dados.logradouro +'" class="form-control"></td>'+
                            '<td><input type="text" value="'+ dados.complemento +'" class="form-control"></td>'+
                            '<td><input type="text" value="" class="form-control"></td>'+
                            '<td><input type="text" value="'+ dados.bairro +'" class="form-control"></td>'+
                            '<td><input type="text" value="'+ dados.localidade +'" class="form-control"></td>'+
                            '<td><input type="text" value="'+ dados.uf +'" class="form-control"></td>' +
                            '<td><input type="text" value="'+ dados.cep +'" class="form-control"></td>'+
                            '<td><img src=\'../assets/images/add.png\' class=\'btnSalvar\' width="16" height="16"/><img src=\'../assets/images/delete.png\' class=\'btnExcluir\' width="16" height="16"/></td>'+
                            '</tr>');

                        $(".btnExcluir").bind("click", Excluir);
                        $(".btnSalvar").bind("click", Salvar);


                    } else {
                        toastr.error("CEP não encontrado.");
                    }
                    //  $('#inputs').append(appending);
                    // appending += '</table>';
                });
            } else {
                toastr.error("Formato de CEP inválido.");
            }
        }   else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    function Salvar(){

        var url = "endereco.php";
        
        var par = $(this).parent().parent(); //tr
        var tdlogradouro = par.children("td:nth-child(1)");
        var tdcomplemento = par.children("td:nth-child(2)");
        var tdnumero = par.children("td:nth-child(3)");
        var tdbairro = par.children("td:nth-child(4)");
        var tdlocalidade = par.children("td:nth-child(5)");
        var tduf = par.children("td:nth-child(6)");
        var tdcep = par.children("td:nth-child(7)");
        var tdBotoes = par.children("td:nth-child(8)");

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'html',
            data: {"logradouro": tdlogradouro.children("input[type=text]").val(),
                   "complemento" : tdcomplemento.children("input[type=text]").val(),
                   "numero" : tdnumero.children("input[type=text]").val(),
                   "bairro" : tdbairro.children("input[type=text]").val(),
                  "localidade" : tdlocalidade.children("input[type=text]").val(),
                   "uf" : tduf.children("input[type=text]").val(),
                   "cep" : tdcep.children("input[type=text]").val(),
                   "usuarioid" : <?=$_GET['id']?>,
                   "acao" :"salvar"
            },
            error: function(){
                toastr.error("Endereço não inserido.");
            },
            success: function(result) {
                console.log(result);
                if($.trim(result) == '1')
                {
                    toastr.success("Endereço inserido com sucesso.");
                } else {
                    toastr.error("Endereço não inserido.");
                }
            }
        });

        tdlogradouro.html(tdlogradouro.children("input[type=text]").val());
        tdcomplemento.html(tdcomplemento.children("input[type=text]").val());
        tdnumero.html(tdnumero.children("input[type=text]").val());
        tdbairro.html(tdbairro.children("input[type=text]").val());
        tdlocalidade.html(tdlocalidade.children("input[type=text]").val());
        tduf.html(tduf.children("input[type=text]").val());
        tdcep.html(tdcep.children("input[type=text]").val());
        tdBotoes.html("<img src='../assets/images/delete.png' class='btnExcluir'/><img src='../assets/images/edit.png' class='btnEditar'/>");
        $(".btnEditar").bind("click", Editar);
        $(".btnExcluir").bind("click", Excluir);

    }

    function Editar(){


        var par = $(this).parent().parent(); //tr
        var tdlogradouro = par.children("td:nth-child(1)");
        var tdcomplemento = par.children("td:nth-child(2)");
        var tdnumero = par.children("td:nth-child(3)");
        var tdbairro = par.children("td:nth-child(4)");
        var tdlocalidade = par.children("td:nth-child(5)");
        var tduf = par.children("td:nth-child(6)");
        var tdcep = par.children("td:nth-child(7)");
        var tdBotoes = par.children("td:nth-child(8)");



        tdlogradouro.html('<input type="text" value="'+ tdlogradouro.html() +'" class="form-control">');
        tdcomplemento.html('<input type="text" value="'+ tdcomplemento.html() +'" class="form-control">');
        tdnumero.html('<input type="text" value="'+ tdnumero.html() +'" class="form-control">');
        tdbairro.html('<input type="text" value="'+ tdbairro.html() +'" class="form-control">');
        tdlocalidade.html('<input type="text" value="'+ tdlocalidade.html() +'" class="form-control">');
        tduf.html('<input type="text" value="'+ tduf.html() +'" class="form-control">');
        tdcep.html('<input type="text" value="'+ tdcep.html() +'" class="form-control">');
        tdBotoes.html("<img src='../assets/images/disk.png' class='btnEditar'/>");
        $(".btnEditar").bind("click", EditarRegistro);



    }

    function Editar(){

        var url = "endereco.php";

        var par = $(this).parent().parent(); //tr
        var tdlogradouro = par.children("td:nth-child(1)");
        var tdcomplemento = par.children("td:nth-child(2)");
        var tdnumero = par.children("td:nth-child(3)");
        var tdbairro = par.children("td:nth-child(4)");
        var tdlocalidade = par.children("td:nth-child(5)");
        var tduf = par.children("td:nth-child(6)");
        var tdcep = par.children("td:nth-child(7)");
        var tdBotoes = par.children("td:nth-child(8)");



        tdlogradouro.html(tdlogradouro.children("input[type=text]").val());
        tdcomplemento.html(tdcomplemento.children("input[type=text]").val());
        tdnumero.html(tdnumero.children("input[type=text]").val());
        tdbairro.html(tdbairro.children("input[type=text]").val());
        tdlocalidade.html(tdlocalidade.children("input[type=text]").val());
        tduf.html(tduf.children("input[type=text]").val());
        tdcep.html(tdcep.children("input[type=text]").val());
        tdBotoes.html("<img src='../assets/images/disk.png' class='btnEditar'/> <img src='../assets/images/delete.png.png' class='btnExcluir'/>");
        $(".btnEditar").bind("click", Editar);
        $(".btnExcluir").bind("click", Excluir);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'html',
            data: {"logradouro": tdlogradouro.children("input[type=text]").val(),
                "complemento" : tdcomplemento.children("input[type=text]").val(),
                "numero" : tdnumero.children("input[type=text]").val(),
                "bairro" : tdbairro.children("input[type=text]").val(),
                "localidade" : tdlocalidade.children("input[type=text]").val(),
                "uf" : tduf.children("input[type=text]").val(),
                "cep" : tdcep.children("input[type=text]").val(),
                "usuarioid" : <?=$_GET['id']?>,
                "acao" :"editar"
            },
            error: function(){
                toastr.error("Endereço não inserido.");
            },
            success: function(result) {
                console.log(result);
                if($.trim(result) == '1')
                {
                    toastr.success("Endereço inserido com sucesso.");
                } else {
                    toastr.error("Endereço não inserido.");
                }
            }
        });

    }


    function Excluir(){
        var par = $(this).parent().parent(); //tr
        par.remove();
    };

</script>

</body>
</html>