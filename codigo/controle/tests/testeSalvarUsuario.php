<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$email = "a@gmaiss";
$senha = "Senha Automatica";
$tipo = "teste";

$idusuario = salvarUsuario($conexao, $nome, $email, $senha, $tipo);

echo $idusuario;