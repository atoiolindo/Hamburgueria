<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idcliente = 1;
$nome = "Fulanooooo";
$telefone = "1111";
$endereco = "Rua Fulano";
$email = "taiobinha@gmail.com";

editarCliente($conexao, $nome, $telefone, $endereco, $idcliente, $email);