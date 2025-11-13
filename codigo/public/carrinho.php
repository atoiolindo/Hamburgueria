<?php
session_start();

require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel=stylesheet href="./css/carrinho.css">
</head>
<body>
    <?php
    if (empty($_SESSION['carrinho'])) {
        echo "carrinho vazio";
    } else {
        $total = 0;
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Tipo</td>";
        echo "<td>Nome</td>";
        echo "<td>Preço</td>";
        echo "<td>Quantidade</td>";
        echo "<td>Total unitário</td>";
        echo "<td>Remover</td>";
        echo "</tr>";

        $ids = array_keys($_SESSION['carrinho']); // pega os IDs do carrinho
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $quantidade = $_SESSION['carrinho'][$id];

            $produto = buscarProdutoPorId($conexao, $id);
            $valor_unitario = isset($produto['valor']) ? (float)$produto['valor'] : 0.0;
            $total_unitario = $valor_unitario * $quantidade;
            $total += $total_unitario;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($produto['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
            echo "<td>R$ " . number_format($valor_unitario, 2, ',', '.') . "</td>";
            echo "<td>" . intval($quantidade) . "</td>";
            echo "<td>R$ " . number_format($total_unitario, 2, ',', '.') . "</td>";
            echo "<td><a href='removerCarrinho.php?id=$id'>[remover]</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<h3>Total da compra: R$ " . number_format($total, 2, ',', '.') . "</h3>";
    }
    ?>

    <p>
        <a href="cardapio.php">Adicionar mais produtos</a> <br>
        <a href="finalizarCompra.php"> Finalizar pedido</a>
    </p>
</body>
</html>
<!-- htmlspecialchars converte caracteres especiais em entidades HTML, para evitar problemas de segurança ou quebra de HTML. -->