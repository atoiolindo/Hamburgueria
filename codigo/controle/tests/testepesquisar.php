<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "";
echo "<pre>";

print_r(pesquisar($conexao, $nome));
echo "</pre>";
?>