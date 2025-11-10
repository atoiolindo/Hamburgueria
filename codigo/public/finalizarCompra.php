<?php
session_start();

require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idusuario = $_SESSION['idusuario'];
$idcliente = $_SESSION['idcliente'] ?? 0;

if ($idcliente == 0) {
    echo "<p>Por favor, cadastre seu endereço antes de finalizar a compra. <a href='perfil.php'>Ir para perfil</a></p>";
    exit;
}

$cliente = pegarDadosCliente($conexao, $idcliente);


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
    <link rel="stylesheet" href="./css/finalizar.css">
</head>
<body>

<div class="container">

    <h2>Seu Pedido</h2>
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

    <h2>Endereço de Entrega</h2>
    <div class="card endereco">
        <?php
        echo htmlspecialchars($cliente['endereco'] ?? 'Endereço não informado') . "<br>";
        ?>
    </div>

    <h2>Resumo do Pedido</h2>
    <div class="card resumo">
        <?php
        $taxa_entrega = 5.00;
        $total_final = $total + $taxa_entrega;
        ?>
        <div><span>Subtotal</span> <span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
        <div><span>Taxa de entrega</span> <span>R$ <?= number_format($taxa_entrega, 2, ',', '.') ?></span></div>
        <div class="total"><span>Total</span> <span>R$ <?= number_format($total_final, 2, ',', '.') ?></span></div>
    </div>

    <form action="../controle/salvarVenda.php" method="POST">
        <input type="hidden" name="idcliente" value="<?= htmlspecialchars($usuario['idcliente']) ?>">
        <input type="hidden" name="valor_final" value="<?= $total_final ?>">
        <input type="hidden" name="data_compra" value="<?= date('Y-m-d') ?>">
        <input type="hidden" name="status" value="pendente">

        <?php
        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            echo "<input type='hidden' name='idproduto[]' value='$id'>";
            echo "<input type='hidden' name='quantidade[$id]' value='$quantidade'>";
        }
        ?>

        <button type="submit" class="botao-finalizar">Finalizar Pedido</button>
    </form>

    <a href="carrinho.php" class="voltar">← Voltar ao carrinho</a>

</div>

</body>
</html>
