<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$quantidade = $_POST['quantidade'];
$nome = $_POST['nome'];

$idingrediente = salvarArmazenamento($conexao, $quantidade, $nome);

if ($id == 0) {
    salvarArmazenamento($conexao, $quantidade, $nome);
} else {
    editarArmazenamento($conexao, $quantidade, $nome, $id);
}

header("Location: ../public/index.php");