<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/esqueci.css">

</head>
<body>

<div class="container">
    
    <?php if (isset($_GET['erro'])):""?>
    <p style="color:red; text-align:center;">Este e-mail não possui cadastro.</p>
    <?php endif; ?>


    <form action="../controle/esqueciSenha.php" method="post">
    <p>Digite seu e-mail:</p>  
    <input type="text" name="email" required>
    
    <div id=div>
        <input type="submit" value="Confirmar">
        <a href="home.php" class="voltar">Voltar</a>
    </div>
</div>
</body>
</html>
