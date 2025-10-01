<?php
session_start();

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : "Usuário";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "usuario@email.com";
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meus Dados</title>
  <style>
    body {
      background: #121212;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 800px;
      margin: 30px auto;
      background: #1e1e1e;
      padding: 20px;
      border-radius: 8px;
    }
    h2 {
      margin-bottom: 20px;
      font-size: 18px;
      color: #fff;
    }
    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .campo {
      display: flex;
      flex-direction: column;
      position: relative;
      max-width: 300px; /* limite horizontal */
    }
    .campo label {
      font-size: 13px;
      margin-bottom: 4px;
      color: #bbb;
    }
    .campo input {
      background: #2b2b2b;
      border: none;
      padding: 8px 10px;
      border-radius: 4px;
      color: #fff;
      width: 100%;
      font-size: 14px;
    }
    .campo input[readonly] {
      opacity: 0.85;
    }
    .btn-editar {
      position: absolute;
      right: -65px; 
      top: 26px;
      background: #444;
      border: none;
      padding: 4px 10px;
      border-radius: 4px;
      cursor: pointer;
      color: #fff;
      font-size: 12px;
      line-height: 1;
    }
    .btn-editar:hover {
      background: #666;
    }
    .aviso {
      font-size: 11px;
      color: orange;
      margin-top: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Dados Pessoais</h2>
    <div class="grid">
      <!-- Nome editável -->
      <div class="campo">
        <label>Nome Completo</label>
        <input type="text" value="<?php echo htmlspecialchars($nome); ?>">
      </div>

      <!-- Email com botão editar -->
      <div class="campo">
        <label>E-mail</label>
        <input type="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        <button class="btn-editar" onclick="window.location.href='verificar.php'">Editar</button>
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
