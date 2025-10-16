<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header("Location: ../public/index.php");
    exit;
}
// Verifica se o usuário é do tipo B
if ($_SESSION['tipo'] !== 'b') {
    header("Location: ../public/index.php");
    exit;
}
?>