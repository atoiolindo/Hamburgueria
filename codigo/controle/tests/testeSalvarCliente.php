<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$endereco = "000.000.000-00";
$email = "Rua Automatico";
$telefone = "bomdiaprincesa";

$idcliente = salvarCliente($conexao, $nome, $endereco, $email,$telefone);

echo $idcliente;