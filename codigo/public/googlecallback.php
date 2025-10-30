<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../controle/conexao.php";
require_once __DIR__ . "/../controle/funcoes.php";

session_start();

use Google\Client;

$client = new Client();
$client->setClientId('751354737095-fo46srd7fqr7k7qke5ok496rbekuv84k.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:83/public/googlecallback.php');
$client->addScope('email');
$client->addScope('profile');

$mensagem = "";

try {
    if (!isset($_GET['code'])) {
        throw new Exception("Código de autenticação não encontrado.");
    }
    
    $dadosGoogle = buscarDadosGoogle($client, $_GET['code']);
    if (empty($dadosGoogle['email']) || empty($dadosGoogle['nome'])) {
        throw new Exception("Não foi possível obter email ou nome do Google.");
    }

    $idusuario = registrarOuBuscarUsuario($conexao, $dadosGoogle['email'], $dadosGoogle['nome']);
    salvarSessaoGoogle($idusuario, $dadosGoogle['email'], $dadosGoogle['nome']);

    $mensagem = "Login realizado com sucesso!";
} catch (Exception $e) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }
    $mensagem = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Callback Google</title>
    <link rel="stylesheet" href="./css/callback.css">
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="success"><?=($mensagem) ?></div>
            <?php if (!isset($_SESSION['idcliente'])): ?>
                <p>Concluir meu cadastro</p>
                <a href="formCliente.php" class="btn">Ir agora</a>
            <?php else: ?>
                <a href="index.php"></a>
            <?php endif; ?>
    </div>
</body>
</html>
