<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idingrediente = 2;

echo "<pre>";
print_r(pesquisarArmazenamento($conexao, $idingrediente));
echo "</pre>";
?>