<?php    
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vendas</title>
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

            $lista_clientes = listarCliente($conexao);

            foreach ($lista_clientes as $cliente) {
                $idcliente = $cliente['idcliente'];
                $nome = $cliente['nome'];

                echo "<option value='$idcliente'>$nome</option>";
            }
            ?>
        </select>

        <br><br>

        Data: <br>
        <input type="date" name="data_compra"><br><br>

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