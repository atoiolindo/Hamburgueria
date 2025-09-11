<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/home.css">

</head>
<body>
<h1>Entre na sua conta</h1>
   

    <form action="../controle/verificarLogin.php" method="post">
    E-mail: <br>
    <input type="text" name="email"> <br><br>
    Senha: <br>
    <input type="text" name="senha"> <br><br>

    <a href="formUsuario.php">Não tem login? Crie um!</a> <br><br>

    <input type="submit" value="Confirmar  ">
</form>
    
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
