<?php

require_once "../conexao.php";
require_once "../funcoes.php";


$nome = "pocao da magia";
$nome_real = "agua tonica";
$ingredientes = "agua tonica";
$valor = "3";
$tipo = "bebida";
$foto = "";
$descricao = "agua tonica lata 350ml";

salvarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao);