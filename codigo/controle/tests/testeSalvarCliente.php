<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$endereco = "000.000.000-01";
$email = "Rua Automatica";
$telefone = "1234341212";

$idcliente = salvarCliente($conexao, $nome, $endereco, $email,$telefone);

echo $idcliente;