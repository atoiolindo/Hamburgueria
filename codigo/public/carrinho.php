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
    <script src="../jquery-3.7.1.min.js"></script>
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
        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            $produto = buscarProdutoPorId($conexao, $id);

            // garante que $produto e $produto['valor'] existam
            $valor_unitario = isset($produto['valor']) ? (float)$produto['valor'] : 0.0;

            $total_unitario = $valor_unitario * $quantidade;
            $total += $total_unitario;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($produto['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
            echo "<td>R$ <span class='valor'>" . number_format($produto['valor'], 2, '.', '') . "</span></td>";
            echo "<td><input type='number' name='quantidade[$id]' class='quantidade' value='$quantidade' data-id='$id' min='1'></td>";

            echo "<td>R$ <span class='total_unitario'>" . number_format($total_unitario, 2, '.', '') . "</span></td>";
            echo "<td><a href='removerCarrinho.php?id=$id'>[remover]</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<h3>Total da compra: R$ <span id='total'>" . number_format($total, 2, '.', '') . "</span></h3>";
    }
    ?>

    <p>
        <a href="cardapio.php"> Adicionar mais produtos </a> <br>
        <a href="gravarCarrinho.php">Gravar compra</a>
    </p>

    <script>
        function atualizar_total() {
            let total = 0;

            $('span.total_unitario').each(function() {
                const valor = parseFloat($(this).text());
                total += valor;
            });

            $('#total').text(total);
        }

        function somar() {
            const linha = $(this).closest('tr');
            const preco_unitario = linha.find('span.preco_venda').text();
            const quantidade = $(this).val();
            const id = $(this).data('id');

            console.log("id é:", id);

            const total = parseFloat(preco_unitario) * parseInt(quantidade);

            const total_unitario = linha.find('span.total_unitario');
            total_unitario.text(total);

            /* Atualizar o valor total da compra */
            atualizar_total();

            console.log("atualizando...");

            const dados_enviados = new URLSearchParams();
            dados_enviados.append('id', id);
            dados_enviados.append('quantidade', quantidade);

            console.log("dados:", dados_enviados);

            fetch('atualizarCarrinho.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: dados_enviados.toString()
                })
                .then(response => response.text())
                .catch(error => console.log('Houve erro:', error));
        }
        $("input[type='number']").change(somar);
    </script>

</body>
</html>
