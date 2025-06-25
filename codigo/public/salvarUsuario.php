<?php
require_once "../controle/conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (email, senha, nome, tipo) VALUES ('$email', '$senha_hash', '$nome', 'c')";

mysqli_query($conexao, $sql);

header("Location: index.php");
?>
