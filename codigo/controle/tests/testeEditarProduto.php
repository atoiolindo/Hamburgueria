<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idproduto = 6;
$nome = "Fulanooooo";
$nome_real = "ola";
$quantidade = "1111";
$ingredientes = "Rua Fulano";
$valor = "taiobinha@gmail.com";
$tipo = "bebida";
$foto = "."; 


echo editarProduto($conexao, $nome, $nome_real, $quantidade, $ingredientes, $valor, $tipo,$idproduto, $foto);