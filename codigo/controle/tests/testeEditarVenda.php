<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idvenda = 2;
$valor_final = 10;
$observacao = "AABB";
$data = "2025-06-25";
$idcliente = 1;
$status = "Não feito";

echo editarVenda($conexao,$idvenda, $valor_final, $observacao, $data, $idcliente, $status);