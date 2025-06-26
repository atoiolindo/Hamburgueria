<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id_venda = 1;
$id_produto = 3;
$quantidade = 10;
$valor = 10;
$observacao = "nao buzina na porta plmDs";

salvarItemVenda($conexao, $id_venda, $id_produto, $quantidade, $valor, $observacao);
?>