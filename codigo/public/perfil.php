<?php
session_start();

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : "Usuário";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "usuario@email.com";
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/perfil.css">
  <title>Meus Dados</title>
</head>
<body>
  
<body>
  <div class="container">
    <h2>Dados Pessoais</h2>
    <div class="grid">
      <div class="campo">
        <label>Nome Completo</label>
        <input type="text" value="<?php echo htmlspecialchars($nome); ?>">
      </div>

      <div class="campo">
        <label>E-mail</label>
        <input type="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        <button class="btn-editar" onclick="window.location.href='..verificar.php'">Editar</button>
      </div>

      <!-- Telefone com botão editar -->
      <div class="campo">
        <label>Telefone <span style="color: orange;">*</span></label>
        <input type="text" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="Seu número" readonly>
        <button class="btn-editar" onclick="window.location.href='verificar.php'">Editar</button>
        <span class="aviso">Campo obrigatório - Usado para contato e suporte</span>
      </div>
    </div>
  </div>
</body>
</html>
