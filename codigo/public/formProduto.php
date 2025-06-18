<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
</head>
<body>
<?php
if (isset($_GET['id'])) {

    require_once "conexao.php";
    $id = $_GET['id'];

    $sql = "SELECT * FROM produto WHERE idproduto = $id";

    $resultados = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_array($resultados);

   
    $nome = $linha['nome'];
    $ingredientes = $linha['ingredientes'];
    $preco = $linha['preco'];

    $botao = "Atualizar";
} else {
    // echo "novo";
    $id = 0;
    $nome = "";
    $ingredientes = "";
    $preco = "";

    $botao = "Cadastrar";
}
?>

    <h1>Cadastro de Produto</h1>
    <form action="salvarProduto.php?id=<?php echo $id; ?>" method="post">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        Nome Real: <br>
        <input type="text" name="nome_real" value="<?php echo $nome_real; ?>"> <br><br>
        Ingredientes utilizados: <br>
        <input type="text" name="ingredientes" value="<?php echo $ingredientes; ?>"> <br><br>
        Valor: <br>
        <input type="text" name="valor" value="<?php echo $valor; ?>"> <br><br>
        Tipo: <br>
        <input type="text" name="tipo" value="<?php echo $tipo; ?>"> <br><br>
        Foto: <br>
        <input type="text" name="valor" value="<?php echo $valor; ?>"> <br><br>
        Descrição: <br>
        <input type="text" name="tipo" value="<?php echo $tipo; ?>"> <br><br>
        
        <input type="submit" value="<?php echo $botao; ?>">
    </form>
<!-- corrigir e verificar dados -->
</body>
</html>