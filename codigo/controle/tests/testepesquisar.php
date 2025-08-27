<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "x";
echo "<pre>";

print_r(pesquisar($conexao, $nome));
echo "</pre>";
?>