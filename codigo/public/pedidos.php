<?php
session_start();

require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idcliente = $_SESSION['idcliente'] ?? 0;

if ($idcliente == 0) {
    echo "<p>Por favor, cadastre seu endereço antes de visualizar pedidos. <a href='perfil.php'>Ir para perfil</a></p>";
    exit;
}

$vendas = pedidoCliente($conexao, $idcliente);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meus Pedidos - Hamburgueria Delícia</title>
  <link rel="stylesheet" href="./css/pedidos.css">
</head>
<body>
  <h1>Meus Pedidos</h1>

  <div id="lista-pedidos">
    <?php if (count($vendas) === 0): ?>
      <p class="no-pedidos">Nenhum pedido encontrado.</p>
    <?php else: ?>
      <?php foreach ($vendas as $venda): ?>
        <div class="pedido">
          <h3>Pedido #<?= htmlspecialchars($venda['idvenda']) ?></h3>
          <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($venda['data'])) ?></p>

          <ul>
            <?php
              $itens = itensPedido($conexao, $venda['idvenda']);
              foreach ($itens as $item):
            ?>
              <li>
                <span><?= $item['quantidade'] ?>x <?= htmlspecialchars($item['nome']) ?></span>
                <span>R$ <?= number_format($item['valor'] * $item['quantidade'], 2, ',', '.') ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <p class="pedido-total"><strong>Total:</strong> R$ <?= number_format($venda['valor_final'], 2, ',', '.') ?></p>
          <p><strong>Status:</strong> <?= ucfirst($venda['status']) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <a href="cardapio.php" class="btn-voltar">Voltar ao Cardápio</a>
</body>
</html>
