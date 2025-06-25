<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$idusuario = 1;
$email = "Cleber";
$senha = "111";
$nome = "Jsaran";

echo editarUsuario($conexao, $email, $senha, $nome); 