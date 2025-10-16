<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

// $idcliente = salvarCliente($conexao, $nome, $email, $endereco, $telefone);


if ($id == 0) {
    $idcliente = salvarCliente($conexao, $nome, $telefone, $endereco);
    if ($idcliente === false) {
        echo "<script>alert('Telefone ou endereço já cadastrado!'); history.back();</script>";
        exit;
    }
} else {
    editarCliente($conexao, $nome, $telefone, $endereco, $id);
}

$_SESSION['nome_completo'] = $nome;
$_SESSION['telefone'] = $telefone;
$_SESSION['endereco'] = $endereco;


header("Location: ../public/index.php");
exit;
?>