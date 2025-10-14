<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$email = "a@gmaiss";
$senha = "Senha Automatica";
$tipo = "teste";
$token ="238923";
$status = "n";

$idusuario = salvarUsuario($conexao, $nome, $email, $senha, $tipo, $token, $status);

echo $idusuario;