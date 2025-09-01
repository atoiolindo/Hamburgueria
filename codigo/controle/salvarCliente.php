<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];

$idcliente = salvarCliente($conexao, $nome, $email, $endereco, $telefone);

if ($idcliente === false) {
    echo "<script>alert('Telefone ou endereço já cadastrado!'); history.back();</script>";
    exit;
}

if ($id == 0) {
    salvarCliente($conexao, $nome, $email, $endereco, $telefone);
} else {
    editarCliente($conexao, $nome, $email, $endereco, $telefone, $id);
}

header("Location: ../public/index.php");