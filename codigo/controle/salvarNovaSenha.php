<?php
require "conexao.php";
require "funcoes.php";

$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];

if ($senha !== $senha2) {
    echo "<script>alert('As senhas não são iguais!'); window.history.back();</script>";
    exit;
}


if (salvarNovaSenha($conexao, $email, $senha)) {
    echo "<script>alert('Senha alterada com sucesso!'); window.location.href='perfil.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar a senha. Tente novamente.'); window.history.back();</script>";
}

?>



