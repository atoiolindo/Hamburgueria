<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$idvenda = 2;
$idproduto = 1;
$quantidade = 10;
$valor = 33;

salvarItemVenda($conexao, $idvenda, $idproduto, $quantidade, $valor);
?>
