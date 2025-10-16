<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];

if (deletarVenda($conexao, $id)) {
    header("Location: ../public/listarVenda.php");
} else {
    header("Location: erro.php");
}
?>