<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idproduto = 6;
$nome = "Fulanooooo";
$quantidade = "1111";
$ingredientes = "Rua Fulano";
$valor = "taiobinha@gmail.com";
$tipo = "bebida";


echo editarProduto($conexao, $nome, $quantidade, $ingredientes, $valor, $tipo,$idproduto);