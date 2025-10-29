<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$id = $_GET['id'];

$produto = buscarProdutoPorId($conexao, $id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div>

    <!-- Imagem -->
    <div>
    </div>


    <!-- Informações -->
    <div>

        <h1><?php echo $produto['nome']; ?></h1>
        <h3><?php echo $produto['nome_real']; ?></h3>
    </div>
</body>
</html>