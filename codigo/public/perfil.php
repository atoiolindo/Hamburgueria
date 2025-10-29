<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

session_start();

if (!isset($_SESSION['idusuario'])) {
  header("Location: home.php");
  exit;
}

$idusuario = $_SESSION['idusuario'];
$usuario = buscarDadosPerfil($conexao, $idusuario);

$nome_completo = $usuario['nome_completo'];
$telefone = $usuario['telefone'];
$endereco = $usuario['endereco'];

$email = $usuario['email'];
$nome = $usuario['nome_usuario'];

$_SESSION['nome'] = $nome;
$_SESSION['email'] = $email;
$_SESSION['nome_completo'] = $nome_completo;
$_SESSION['telefone'] = $telefone;
$_SESSION['endereco'] = $endereco;

if (isset($_POST['telefone'])) {
    $telefone = trim($_POST['telefone']);
    $_SESSION['telefone'] = $telefone; 
    $msg = "Telefone atualizado com sucesso!";
} 
elseif (isset($_POST['nome_usuario'])) {
    $nome = trim($_POST['nome_usuario']);
    $_SESSION['nome_usuario'] = $nome; 
    $msg = "Nome de usuário atualizado com sucesso!";
} 
elseif (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $_SESSION['email'] = $email; 
    $msg = "E-mail atualizado com sucesso!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/perfil.css">
  <title>Meus Dados</title>
  <script src="../controle/jquery-3.7.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
  <script src="../controle/funcoes.js"></script>
  <script src="../controle/mask.js"></script>
  
</head>
  
<body>
  <div class="container">
    <h2>Dados Pessoais</h2>
    <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

    <div class="grid">
      <div class="campo">
        <label>Nome Completo</label>
        <input type="text" value="<?php echo ($nome_completo); ?>" readonly>
      </div>

      <div class="campo">
        <label>Nome de Usuario</label>
        <input type="text" value="<?php echo ($nome); ?>" readonly>
      </div>

      <div class="campo">
        <label>E-mail <span id="asterisco">*</label>

        <form method="post" id="email-form">
          <input type="text" name="email" id="email" class="email" value="<?php echo ($email); ?>" placeholder="Seu e-mail" readonly>
          <button type="button" class="editar" onclick="window.location.href='../controle/verificarEmail.php?email=<?php echo($email); ?>'">Editar</button>
          <span class="aviso">Campo obrigatório </span>
        </form>

      </div>

      <div class="campo">
        <label>Telefone <span id="asterissco">*</span></label>
          
        <form method="post" id="telefone-form">
          <input type="text" name="telefone" id="telefone" class="telefone" value="<?php echo ($telefone); ?>" placeholder="Seu número" readonly>
          <button type="button" class="editar" onclick="editarTelefone()">Editar</button>
          <button type="submit" id="salvar" class="salvar">Salvar</button>
          <span class="aviso">Campo obrigatório </span>
        </form>

      </div>

      <div class="campo">
        <label> Endereco <span id="asterisco">*</label>

        <form method="post" id="endereco-form">
          <input type="text" name="endereco" id="endereco" class="endereco" value="<?php echo ($endereco); ?>" placeholder="Seu endereco" readonly>
          <span class="aviso">Campo obrigatório </span>
        </form>

      </div>


      <div id="voltar">
        <a href="index.php" class="voltar">Voltar</a>
      </div>


    </div>
  </div>
</body>
</html>
 

