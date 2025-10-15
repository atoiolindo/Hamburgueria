<?php
if (!isset($_GET['email'])) {
    header("Location: esqueciSenha.php");
    exit;
}

$email = $_GET['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Nova Senha</title>
<link rel="stylesheet" href="./css/esqueci.css">
</head>
<body>
<div class="container">
    <h1>Criar Nova Senha</h1>
    <form action="salvarNovaSenha.php" method="post">
        <input type="hidden" name="email" value="<?php echo ($email); ?>">
        <p>Nova senha:</p>
        <input type="password" name="senha" required>
        <p>Confirme a nova senha:</p>
        <input type="password" name="senha2" required>
        <input type="submit" value="Salvar" style="margin-top: 20px;">
    </form>
    <a href="perfil.php" class="voltar">Voltar</a>
</div>
</body>
</html>
