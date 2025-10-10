<?php
session_start();

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : "";

if (isset($_POST['telefone'])) {
    $telefone = trim($_POST['telefone']);
    $_SESSION['telefone'] = $telefone; 
    $msg = "Telefone atualizado com sucesso!";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/perfil.css">
  <title>Meus Dados</title>
  <script href="../controle.funcoes.js"></script>
  
</head>
<body>
  
<body>
  <div class="container">
    <h2>Dados Pessoais</h2>
    <div class="grid">
      <div class="campo">
        <label>Nome Completo</label>
        <input type="text" value="<?php echo htmlspecialchars($nome); ?>" readonly>
      </div>

      <div class="campo">
        <label>E-mail <span style="color: brown;">*</label>

        <input type="text" value="<?php echo htmlspecialchars($telefone); ?>" 
        id="email" placeholder="Seu e-mail" readonly>


        <button class="editar" onclick="window.location.href='./verificarEmail.php?email=<?php echo htmlspecialchars
        ($email); ?>'">Editar</button>
        <span class="aviso">Campo obrigatório </span>

      </div>

      <div class="campo">
        <label>Telefone <span style="color: brown;">*</span></label>
        <input type="text" value="<?php echo htmlspecialchars($telefone); ?>" id="telefone" placeholder="Seu número" readonly>
        <button class="editar">Editar</button>
        <span class="aviso">Campo obrigatório </span>
      </div>
    </div>
  </div>
</body>
</html>
