<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idarmazenamnto = 1;
$nome = "elixir revigorante";
$quantidade = "4";


editarArmazenamento($conexao, $nome, $quantidade, $idarmazenamento);