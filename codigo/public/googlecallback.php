<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/callback.css">

</head>
<body>

<div class="container">
    
    <h1>Continue seu cadastro</h1>

    <?php if (isset($_GET['erro'])):""?>
    <p style="color:red; text-align:center;">Este e-mail não possui cadastro.</p>
    <?php endif; ?>


    <form action="./verificarTelefone.php" method="post">
    <p>Digite seu telefone:</p>  
    <input type="number" name="number" required>
    
    <div id=div>
        <input type="submit" value="Confirmar">
        <a href="home.php" class="voltar">Voltar</a>
    </div>
</div>
</body>
</html>
