<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

session_start(); 

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];

$tipo = "c";
$token = gerarTokenUnico($conexao);
$status = "nao";

$idusuario = salvarUsuario($conexao, $nome, $email, $senha, $tipo, $token, $status);

if ($idusuario !== false) {

    $_SESSION['idusuario'] = $idusuario;

    header("Location: ../public/callback.php");
    exit;
} else {
    header("Location: ../public/index.php");
    exit;
}
?>
