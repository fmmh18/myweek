<?

include_once "../controller/UsuarioController.php";
$usuario = new UsuarioController();


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

    $obj = array('nome'=>$_POST['nome'],'email'=>$_POST['email'],'telefone'=>$_POST['telefone']);
    $insert = $usuario->adicionarUsuarios($obj);
    if($insert == true){
        ?>
        <script>
            toastr.success("Registro inserido.");
        </script>

        <?
        sleep(5);
        header('location:listar.php');
    }else{
       ?>
        <script>
            toastr.danger("Registro não inserido.");
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
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo(*)" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>E-mail<sup>(*)</sup></b></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-mail(*)" required>
                </div>
                <div class="form-group">
                    <label for="telefone"><b>Telefone<sup>(*)</sup></b></label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone(*)" required>
                </div>
                <div class="form-group">
                    <label for="selectQtdEndereco"><b>Inserir Endereço</b></label>

                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" value="Cadastrar" name="acao"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
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
                                '<td><input type="text" value="'+ dados.logradouro +'" class="form-control" name="logradouro[]"></td>'+
                                '<td><input type="text" value="'+ dados.complemento +'" class="form-control" name="complemento[]"></td>'+
                                '<td><input type="text" value="" class="form-control" name="numero[]"></td>'+
                                '<td><input type="text" value="'+ dados.bairro +'" class="form-control" name="bairro[]"></td>'+
                                '<td><input type="text" value="'+ dados.localidade +'" class="form-control" name="localidade[]"></td>'+
                                '<td><input type="text" value="'+ dados.uf +'" class="form-control" name="uf[]"></td>' +
                                '<td><input type="text" value="'+ dados.cep +'" class="form-control" name="cep[]"></td>'+
                                '<td><img src=\'../assets/images/delete.png\' class=\'btnExcluir\' width="16" height="16"/></td>'+
                                '</tr>');

                            $(".btnExcluir").bind("click", Excluir);

                            toastr.success("Endereço adicionado.");

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
    function Excluir(){
        var par = $(this).parent().parent(); //tr
        par.remove();
    };

</script>

</body>
</html>