<?php
session_start();
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idcliente = $_SESSION['idcliente'];

// Busca todas as vendas do cliente
$vendas = pedidoCliente($conexao, $idcliente);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/pagamento.css">
  <title>Pagamentos</title>
</head>
<body>

  <div class="container">
    <h2>Pagamentos</h2>
    <p class="descricao">Veja o status dos seus pedidos:</p>

    <?php if (!empty($vendas)): ?>
      <?php foreach ($vendas as $venda): ?>
        <?php
          // Define a classe e o texto com base no status
          $statusClasse = '';
          $statusTexto = '';

          switch ($venda['status']) {
            case 'pago':
              $statusClasse = 'ativo';
              $statusTexto = 'Pago';
              break;
            case 'pendente':
              $statusClasse = 'pendente';
              $statusTexto = 'Pendente';
              break;
            default:
              $statusClasse = 'cancelado';
              $statusTexto = 'Cancelado';
          }
        ?>

        <div class="metodo <?php echo $statusClasse; ?>">
          <div class="icone">
            <?php if ($statusClasse === 'ativo'): ?>
              <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Pago">
            <?php elseif ($statusClasse === 'pendente'): ?>
              <img src="https://cdn-icons-png.flaticon.com/512/595/595067.png" alt="Pendente">
            <?php else: ?>
              <img src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="Cancelado">
            <?php endif; ?>
          </div>

          <div class="info">
            <h3>Pedido #<?php echo $venda['idvenda']; ?></h3>
            <p>Data: <?php echo date('d/m/Y', strtotime($venda['data'])); ?></p>
            <p>Total: R$ <?php echo number_format($venda['valor_final'], 2, ',', '.'); ?></p>
          </div>

          <div class="status">
            <span class="<?php echo $statusClasse; ?>"><?php echo ucfirst($statusTexto); ?></span>
          </div>
        </div>

      <?php endforeach; ?>
    <?php else: ?>
      <p>Você ainda não fez nenhum pedido.</p>
    <?php endif; ?>

    <div id="voltar">
      <a href="index.php" class="voltar">Voltar</a>
    </div>

  </div>

</body>
</html>
