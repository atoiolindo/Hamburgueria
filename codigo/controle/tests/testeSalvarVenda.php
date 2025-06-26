<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$valor_final = 1;
$observacao = "Kleber";
$data = "2025-03-27";
$idcliente = 1;
$status = "feito";

salvarVenda($conexao, $idcliente, $valor_final, $observacao, $status, $data);

?>