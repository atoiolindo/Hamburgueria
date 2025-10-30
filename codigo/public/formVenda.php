<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";
verificarPermissao(['a', 'b']);

if (isset($_GET['id'])) {
    $idvenda = $_GET['id'];

    $venda = pesquisarVenda($conexao, $idvenda); 
    $idcliente = $venda['idcliente'];
    $valor_final = $venda['valor_final'];
    $data = $venda['data'];
    $observacao = $venda['observacao'];
    $status = $venda['status'];
 
    $itens_venda = listarItemVenda($conexao, $idvenda); // retorna array associativo [idproduto => quantidade]

    $botao = "Atualizar Venda";
    $favicon = './assets/editar.png';
} else {
    $idvenda = 0;
    $idcliente = null;
    $valor_final = 0;
    $data = date('Y-m-d');
    $observacao = '';
    $status = 'pendente';
    $itens_venda = [];

    $botao = "Registrar Venda";
    $favicon = './assets/cadastrar.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $botao; ?></title>
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">
    <script src="../controle/jquery-3.7.1min(1).js"></script>
    <script src="../controle/funcoes.js"></script>
    <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
    <div class="form-container">
    <form action="../controle/salvarVenda.php?id=<?php echo $idvenda; ?>" method="post" enctype="multipart/form-data">
        Cliente: <br>
        <select name="idcliente" id="idcliente">
            <?php
            require_once "../controle/conexao.php";
            require_once "../controle/funcoes.php";

            // colocar um icone bonitinho de editar depois

            $lista_clientes = listarCliente($conexao);
            foreach ($lista_clientes as $cliente) {
            $selected = $cliente['idcliente'] == $idcliente ? "selected" : "";
            echo "<option value='{$cliente['idcliente']}' $selected>{$cliente['nome']}</option>";
             }
        ?>
            ?>
        </select>

        <br><br>

        Data: <br>
        <input type="date" id="data" name="data_compra" value="<?php echo $data; ?>"    required><br><br>

        Produtos: <br>
        <?php
        $lista_produtos = listarProduto($conexao);
        foreach ($lista_produtos as $produto) {
            $idproduto = $produto['idproduto'];
            $nome = $produto['nome'];
            $valor = number_format($produto['valor'], 2, '.', '');
            
            // Pega a quantidade correta ou 0
            $qtd = isset($itens_venda[$idproduto]) ? $itens_venda[$idproduto]['quantidade'] : 0;
            $checked = $qtd > 0 ? "checked" : "";

            echo "<input type='checkbox' name='idproduto[]' value='$idproduto' id='marcado_$idproduto' $checked onchange='calcular()'>
                  R$ <span id='preco_$idproduto'>$valor</span> - $nome 
                  <input type='number' name='quantidade[$idproduto]' id='quantidade_$idproduto' value='$qtd' min='0' onchange='calcular()'><br>";
        }
        ?>
        <br>
        Valor Total: <br>
        <input type="hidden" name="valor_final" id="valor_final" value="<?php echo $valor_final; ?>">
        <span id="mostrar_total"><?php echo number_format($valor_final, 2, '.', ''); ?></span> <br><br>
        
        Observação: <br>
        <textarea name="observacao"><?php echo $observacao; ?></textarea><br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    
    </form>
    <div class="form-container">
</body>

</html>