<?php
require_once "conexao.php";
require_once "funcoes.php";

session_start();

if (!isset($_SESSION['idusuario'])) {
    echo "<script>alert('Você precisa estar logado para continuar.'); window.location.href = '../public/home.php';</script>";
    exit;
}

$idusuario = $_SESSION['idusuario'];
$nome = trim($_POST['nome']);
$telefone = trim($_POST['telefone']);
$endereco = trim($_POST['endereco']);

if (empty($nome) || empty($telefone) || empty($endereco)) {
    echo "<script>alert('Por favor, preencha todos os campos.'); history.back();</script>";
    exit;
}

$idcliente = salvarCliente($conexao, $nome, $telefone, $endereco, $idusuario);

if ($idcliente === false) {
    echo "<script>alert('Telefone ou endereço já cadastrado!'); history.back();</script>";
    exit;
}

$_SESSION['idcliente'] = $idcliente;
$_SESSION['nome'] = $nome;
$_SESSION['telefone'] = $telefone;
$_SESSION['endereco'] = $endereco;

header("Location: ../public/perfil.php");
exit;
?>
