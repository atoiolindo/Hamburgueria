<?php
require_once "conexao.php";
require_once "funcoes.php";

session_start();

if (!isset($_SESSION['idusuario'])) {
    echo "<script>alert('ID do usuário não foi fornecido.'); window.history.back();</script>";
    exit;
}

$idusuario = $_SESSION['idusuario'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

$idcliente = salvarCliente($conexao, $nome, $telefone, $endereco, $idusuario);
if ($idcliente === false) {
    echo "<script>alert('Telefone ou endereço já cadastrado!'); history.back();</script>";
    exit;
}

$_SESSION['nome_cliente'] = $nome;
$_SESSION['telefone_cliente'] = $telefone;
$_SESSION['endereco_cliente'] = $endereco;

header("Location: ../public/perfil.php");
exit;
?>