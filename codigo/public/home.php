<?php
require __DIR__ . '/../vendor/autoload.php';


session_start();

$client = new Google_Client();
$client->setClientId('751354737095-fo46srd7fqr7k7qke5ok496rbekuv84k.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:83/public/googlecallback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/home.css">

</head>
<body>

<div class="container">
    
    <h1>Entre na sua conta</h1>
   
    <form action="../controle/verificarLogin.php" method="post">
    E-mail: <br>
    <input type="text" name="email"> <br><br>
    
    Senha: <br>
    <input type="password" name="senha"> <br><br>

    <a href="<?= $login_url ?>" class="btn-google">
    <!-- SVG do "G" do Google -->
    <svg width="20" height="20" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
        <path fill="#4285F4" d="M533.5 278.4c0-18.5-1.5-36.5-4.3-53.9H272v102.2h146.9c-6.4 34.5-25.6 63.8-54.6 83.4l88.2 68.6c51.3-47.3 81-116.9 81-200.3z"/>
        <path fill="#34A853" d="M272 544.3c73.4 0 135-24.3 180-66.1l-88.2-68.6c-24.5 16.5-55.6 26-91.8 26-70.8 0-130.7-47.9-152.3-112.2l-90.6 70c43.4 86.2 132 150.9 243 150.9z"/>
        <path fill="#FBBC05" d="M119.9 320.4c-10.4-30.5-10.4-63.4 0-93.9l-90.6-70C-15.7 207.1-15.7 337.2 29.3 406.9l90.6-70.5z"/>
        <path fill="#EA4335" d="M272 107.7c39.9 0 75.7 13.7 104 40.5l78-78C403.1 24.4 341.5 0 272 0 160.9 0 72.3 64.7 28.9 150.9l90.6 70.5C141.3 155.6 201.2 107.7 272 107.7z"/>
    </svg>
    Entrar com Google
    </a>

    <a href="formUsuario.php">Não tem login? Crie um!</a>
    <input type="submit" value="Confirmar">
    </form>
</div>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login/Cadastro</title>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <h1>Bem-vindo!</h1>
    <div class="login-options">
        <button onclick="window.location.href='login_google.php'">Entrar com Google</button><br>
        <button onclick="window.location.href='login_apple.php'">Entrar com Apple</button><br>
        <button onclick="showEmailForm()">Entrar com E-mail</button><br>
    </div>

    <form id="emailForm" action="enviar_codigo_email.php" method="post" style="display:none;">
        <label>E-mail:</label><br>
        <input type="email" name="email" required><br>
        <button type="submit">Enviar código</button>
    </form>

    <!-- Após envio do código, mostre este formulário -->
    <!-- <form id="codigoEmailForm" action="validar_codigo_email.php" method="post" style="display:none;">
        <label>Código recebido no e-mail:</label><br>
        <input type="text" name="codigo_email" required><br>
        <button type="submit">Validar código</button>
    </form> -->

    <!-- Após validar e-mail, mostre este formulário -->
    <!-- <form id="telefoneForm" action="enviar_codigo_sms.php" method="post" style="display:none;">
        <label>Telefone:</label><br>
        <input type="text" name="telefone" required><br>
        <button type="submit">Enviar código SMS</button>
    </form> -->

    <!-- Após envio do código SMS, mostre este formulário -->
    <!-- <form id="codigoSmsForm" action="validar_codigo_sms.php" method="post" style="display:none;">
        <label>Código recebido por SMS:</label><br>
        <input type="text" name="codigo_sms" required><br>
        <button type="submit">Validar código</button>
    </form> -->

    <!-- Se novo usuário, peça nome e crie conta -->
    <!-- <form id="cadastroForm" action="criar_conta.php" method="post" style="display:none;">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <button type="submit">Criar conta</button>
    </form> -->

    <!-- <script>
        function showEmailForm() {
            document.getElementById('emailForm').style.display = 'block';
        } -->
