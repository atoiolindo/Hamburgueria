<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Entre na sua conta</h1>

    <form action="../controle/verificarLogin.php" method="post">
    E-mail: <br>
    <input type="text" name="email"> <br><br>
    Senha: <br>
    <input type="text" name="senha"> <br><br>

    <a href="formUsuario.php">Não tem login? Crie um!</a> <br><br>

    <input type="submit" value="Confirmar   ">
</form>
    
</body>
</html>