<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$endereco = "Rua do Teste";
$email = "teste@gmail.com";
$telefone = "1234341215";

$idcliente = salvarCliente($conexao, $nome, $endereco, $email,$telefone);

echo $idcliente;