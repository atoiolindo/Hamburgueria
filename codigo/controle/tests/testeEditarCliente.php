<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idcliente = 6;
$nome = "Fulanooooo";
$telefone = "1111";
$endereco = "Rua Fulano";
$email = "taiobinha@gmail.com";

// echo editarCliente($conexao, $idcliente, $nome, $telefone, $endereco, $email);
echo editarCliente($conexao, $nome, $telefone, $endereco,  $email, $idcliente); 