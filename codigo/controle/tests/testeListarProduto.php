<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$idproduto = 4;

echo "<pre>";
print_r(listarProduto($conexao));
echo "</pre>";

?>