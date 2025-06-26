<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$idingrediente = 2;
$idproduto = 4;
$quantidade = 10;

salvarIngrediente($conexao, $idproduto, $idingrediente, $quantidade);
?>