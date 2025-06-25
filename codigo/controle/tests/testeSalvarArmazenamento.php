<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Hamburguer de carne";
$quantidade = "3";


$idingrediente = salvarArmazenamento($conexao, $nome, $quantidade);

echo $idingrediente;