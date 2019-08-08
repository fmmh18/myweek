<?
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
include_once "../controller/UsuarioController.php";
$usuario = new UsuarioController();

$usuarios = $usuario->listarUsuarios();
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <title>MyWeek</title>
</head>
<body>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <br/>
                <a href="inserir.php" class="btn btn-primary float-right">Adicionar</a>
            <br/><br/>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>Telefone</td>
                        <td>Email</td>
                        <td></td>
                    </tr>
                </thead>
                <? if(count($usuarios) == 0){ ?>
                    <tr>
                        <td colspan="5" class="text-center"><b>Não existe usuários cadastrados</b></td>
                    </tr>
                <? }else{
                    foreach($usuarios as $usuario){
                        echo "<tr>";
                        echo "<td>".$usuario->id."</td>";
                        echo "<td>".$usuario->nome."</td>";
                        echo "<td>".$usuario->telefone."</td>";
                        echo "<td>".$usuario->email."</td>";
                        echo "<td><a href='editar.php?id=".$usuario->id."'><img src='../assets/images/edit.png'></a> <a href='javascript:void(0)' onclick='excluirUsuario(".$usuario->id.")'><img src='../assets/images/delete.png' width='16' height='16'></a></td>";
                        echo "</tr>";
                    }

                } ?>
            </table>
        </div>
    </div>
</div>
<script>

    function excluirUsuario(id)
    {
        if(confirm("deseja realmente excluir esse registro?") == true){
            window.location.href = 'usuario.php?id='+id;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>