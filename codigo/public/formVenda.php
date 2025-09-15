<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (isset($_GET['id'])) {
    $idvenda = $_GET['id'];

    $venda = pesquisarVenda($conexao, $idvenda); 
    $idcliente = $venda['idcliente'];
    $valor_final = $venda['valor_final'];
    $data = $venda['data_compra'];
    $observacao = $venda['observacao'];
    $status = $venda['status'];

    $itens_venda = listarItemVenda($conexao, $idvenda); // retorna array associativo [idproduto => quantidade]

    $botao = "Atualizar Venda";
} else {
    $idvenda = 0;
    $idcliente = 0;
    $valor_final = 0;
    $data = date('Y-m-d');
    $observacao = '';
    $status = 'pendente';
    $itens_venda = [];

    $botao = "Registrar Venda";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $botao; ?></title>

    <script src="../controle/jquery-3.7.1min(1).js"></script>
    <script src="../controle/funcoes.js"></script>
</head>

<body>
    <form action="../controle/salvarVenda.php">
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
        <input type="date" id="data" name="data_compra" required><br><br>

        Produtos: <br>
        <?php
        $lista_produtos = listarProduto ($conexao);

        foreach ($lista_produtos as $produto) {
            $idproduto = $produto['idproduto'];
            $nome = $produto['nome'];
            $valor = $produto['valor'];

           echo "<input type='checkbox' value='$idproduto' id='marcado_$idproduto' name='idproduto[]' onchange='calcular()'> 
           R$ <span id='preco_$idproduto'>$valor</span> - $nome ";
           echo "<input type='number' name='quantidade[$idproduto]' id='quantidade_$idproduto' value='0' onchange='calcular()'><br>";
        }
        ?>
        <br>
        Valor Total: <br>
        <<input type="hidden" name="valor_final" id="valor_final">
        <span id="mostrar_total">0.00</span> <br><br>

        <input type="submit" value="Registrar Venda"> <br>
    
    </form>
    <button>Botão de testes</button>
</body>

</html>