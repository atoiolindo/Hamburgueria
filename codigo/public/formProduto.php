<?php
    if (isset($_GET['id'])) {

        require_once "../controle/conexao.php";
        require_once "../controle/funcoes.php";
        
        $id = $_GET['id'];
        
        $produto = pesquisarProduto($conexao, $id);
        $nome = $produto['nome'];
        $nome_real = $produto['nome_real'];
        $ingredientes = $produto['ingredientes'];
        $ingredientes_existentes = listarIngrediente($conexao, $id); 
        $valor = $produto['valor'];
        $tipo = $produto['tipo'];
        $foto = $produto['foto'];
        $descricao = $produto['descricao'];

        $botao = "Atualizar";
    } 
    else {

        $id = 0;
        $nome = "";
        $nome_real = "";
        $ingredientes = "";
        $ingredientes_existentes = [];
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
        <input type="text" name="ingredientes" value="<?php echo $ingredientes; ?>"> 
        
        <br><br>
        Quantidade de ingredientes: <br>
        <?php
        require_once "../controle/conexao.php";
        require_once "../controle/funcoes.php";
        $lista_ingredientes = listarArmazenamento($conexao);

        foreach ($lista_ingredientes as $ingrediente) {
        $idingrediente = $ingrediente['idingrediente'];
        $nome = $ingrediente['nome'];

         // verifica se já existe esse ingrediente no produto
        $quantidade_valor = 0;
        foreach ($ingredientes_existentes as $ing_existente) {
        if ($ing_existente['idingrediente'] == $idingrediente) {
            $quantidade_valor = $ing_existente['quantidade'];
            break;
              }
           }

            echo "<input type='checkbox' value='$idingrediente' 
            id='marcado_$idingrediente' 
            name='idingrediente[]' 
            ".($quantidade_valor > 0 ? "checked" : "")."> 
            $nome ";

            echo "<input type='number' 
            name='quantidade[$idingrediente]' 
            id='quantidade_$idingrediente' 
            value='$quantidade_valor'><br>";
        }
        ?>

        <br>
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