<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: home.php"); // força login
    exit;
}
?>

<h1>Perfil de <?php echo htmlspecialchars($_SESSION['nome']); ?></h1>
<p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
<a href="../controle/deslogar.php">Sair</a>
