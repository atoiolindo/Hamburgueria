<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_POST['email']) || !isset($_POST['codigo'])) {
    header("Location: esqueciSenha.php");
    exit;
}

$email = $_POST['email'];
$codigo = $_POST['codigo'];

$idusuario = verificarEmail($conexao, $email);
$token = pegarToken($conexao, $idusuario);

if ($codigo === $token) {
    header("Location: novaSenha.php?email=" . urlencode($email));
    exit;
} else {
    echo "<p style='color:red;text-align:center;'>Código incorreto.</p>";
    echo "<p style='text-align:center;'><a href='digitarCodigo.php?email=" . urlencode($email) . "'>Tentar novamente</a></p>";
    exit;
}
