<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];

if (deletarArmazenamento($conexao, $id)) {
    header("Location: ../public/listarArmazenamento.php");
} else {
    header("Location: erro.php");
}
?>