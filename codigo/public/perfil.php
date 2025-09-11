<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: formUsuario.php");
    exit();
}
?>