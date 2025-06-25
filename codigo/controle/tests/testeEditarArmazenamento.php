<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idproduto = 2;
$nome = "elixir revigorante";
$nome_real = "abuleibos";
$ingredientes = "abuleibos abuleis abulerestes";
$valor = 10;
$tipo = "bebida";
$foto = "";
$descricao = "bebida bem boa e gostosa  ";

editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto);