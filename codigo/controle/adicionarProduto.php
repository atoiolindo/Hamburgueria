<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];

if (ativarProduto($conexao, $id)) {
    header("Location: ../public/listarProdutoInativo.php");
} else {
    header("Location: erro.php");
}
?>