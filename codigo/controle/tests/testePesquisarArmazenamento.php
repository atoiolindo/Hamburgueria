<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idingredientes = 2;

echo "<pre>";
print_r(pesquisarArmazenamento($conexao, $idingredientes));
echo "</pre>";
?>