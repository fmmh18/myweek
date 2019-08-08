<?

include_once "../controller/UsuarioController.php";
include_once "../controller/EnderecoController.php";

$usuario = new UsuarioController();
$endereco = new EnderecoController();

$usuario->excluirUsuarios($_GET['id']);

$endereco->excluirEndereco($_GET['id']);
header("location:listar.php");
