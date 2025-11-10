<?php
session_start();

require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idusuario = $_SESSION['idusuario'];
$usuario = pegarDadosUsuario($conexao, $idusuario); // deve retornar nome, endereco, telefone etc.

if (empty($_SESSION['carrinho'])) {
    echo "<p>Seu carrinho está vazio. <a href='cardapio.php'>Voltar ao cardápio</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido</title>
    <link rel="stylesheet" href="finalizar.css">
</head>
<body>

<div class="container">

    <h2>🛒 Seu Pedido</h2>
    <div class="card">
        <?php
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            $produto = buscarProdutoPorId($conexao, $id);
            if (!$produto) continue;
            
            $subtotal = $produto['valor'] * $quantidade;
            $total += $subtotal;
            echo "
            <div class='item'>
                <div>
                    <div class='item-nome'>".htmlspecialchars($produto['nome'])."</div>
                    <div class='item-qtd'>Qtd: $quantidade</div>
                </div>
                <div class='item-info'>
                    <div>R$ ".number_format($produto['valor'], 2, ',', '.')."</div>
                    <div style='font-size:14px;color:#777;'>Subtotal: R$ ".number_format($subtotal, 2, ',', '.')."</div>
                </div>
            </div>";
        }
        ?>
    </div>

    <h2>📍 Endereço de Entrega</h2>
    <div class="card endereco">
        <?php
        echo htmlspecialchars($usuario['nome_completo']) . "<br>";
        echo htmlspecialchars($usuario['endereco']) . "<br>";
        echo "Telefone: " . htmlspecialchars($usuario['telefone']);
        ?>
    </div>

    <h2>💰 Resumo do Pedido</h2>
    <div class="card resumo">
        <?php
        $taxa_entrega = 5.00;
        $total_final = $total + $taxa_entrega;
        ?>
        <div><span>Subtotal</span> <span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
        <div><span>Taxa de entrega</span> <span>R$ <?= number_format($taxa_entrega, 2, ',', '.') ?></span></div>
        <div class="total"><span>Total</span> <span>R$ <?= number_format($total_final, 2, ',', '.') ?></span></div>
    </div>

    <form action="confirmarPedido.php" method="POST">
        <input type="hidden" name="total" value="<?= $total_final ?>">
        <button type="submit" class="botao-finalizar">Finalizar Pedido</button>
    </form>

    <a href="carrinho.php" class="voltar">← Voltar ao carrinho</a>

</div>

</body>
</html>