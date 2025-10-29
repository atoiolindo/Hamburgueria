<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];

if (inativarProduto($conexao, $id)) {
    header("Location: ../public/index.php");
} else {
    header("Location: erro.php");
}
?>