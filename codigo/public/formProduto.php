<?php
    if (isset($_GET['id'])) {

        require_once "conexao.php";
        require_once "funcoes.php";
        
        $id = $_GET['id'];
        
        $produto = pesquisarProduto($conexao, $id);
        $nome = $linha['nome'];
        $nome_real = $linha['nome_real'];
        $ingredientes = $linha['ingredientes'];
        $valor = $linha['valor'];
        $tipo = $linha['tipo'];
        $foto = $linha['foto'];
        $descricao = $linha['descricao'];

        $botao = "Atualizar";
    } 
    else {

        $id = 0;
        $nome = "";
        $nome_real = "";
        $ingredientes = "";
        $valor = "";
        $tipo = "";
        $foto = "";
        $descricao = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form action="../controle/salvarProduto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        Nome Verdadeiro: <br>
        <input type="text" name="nome_real" value="<?php echo $nome_real; ?>"> <br><br>
        Ingredientes utilizados: <br>
        <input type="text" name="ingredientes" value="<?php echo $ingredientes; ?>"> <br><br>
        Valor: <br>
        <input type="text" name="valor" value="<?php echo $valor; ?>"> <br><br>
        Tipo: <br>
        <input type="text" name="tipo" value="<?php echo $tipo; ?>"> <br><br>
        Foto: <br>
        <input type="file" name="foto" value="<?php echo $foto; ?>"> <br><br>
        Descrição: <br>
        <input type="text" name="descricao" value="<?php echo $descricao; ?>"> <br><br>
        
        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>