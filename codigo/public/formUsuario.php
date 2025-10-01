<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/formUsuario.css">

</head>
<body>

<div class="container">
    
    <h1>Crie seu cadastro</h1>
   
    <form action="../controle/salvarUsuario.php" method="post">
 
    Nome de usuário: 
    <input type="text" name="nome">
    
    E-mail: 
    <input type="text" name="email">
    
    Senha: 
    <input type="password" name="senha">

    <input type="submit" value="Próximo">
    </form>
</div>
</body>
</html>
