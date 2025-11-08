<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_GET['email'])) {
    header("Location: ../public/digitarCodigoVerificar.php");
    exit;
}

$email = $_GET['email'];

$idusuario = verificarEmail($conexao, $email);
if ($idusuario == 0) {
    header("Location: ../public/digitarCodigoVerificar.php?erro=2");
    exit;
}

$atualizado = emailVerificado($conexao, $idusuario);
if (!$atualizado) {
    echo "<p style='color:red;text-align:center;'>Erro ao atualizar status. Tente novamente.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verificado</title>
    <link rel="stylesheet" href="./css/verificado.css">
</head>
<body>
    <div class="container">
        <h1 class="success-message">Email verificado com sucesso!!</h1>
        <p>Seu email foi confirmado. Agora você pode acessar todas as funcionalidades da conta.</p>
        <a href="perfil.php" class="voltar">Ir para o Perfil</a>
    </div>
</body>
</html>
