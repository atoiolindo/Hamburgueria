<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$tipo = "c";
$token = gerarTokenUnico($conexao);
$status = "nao";

if ($email != "") {
    salvarUsuario($conexao, $nome, $email, $senha, $tipo, $token, $status);
    header("Location: ../public/callback.php");
    exit;
}
else {
    header("Location: ../public/index.php");
    exit;
}
?>
