<?php
session_start(); // Inicia a sessão
session_destroy(); // Destrói todas as variáveis de sessão
header("Location: ../public/index.php"); // Redireciona o usuário para a página inicial
?>