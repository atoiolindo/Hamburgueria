  <?php
  require_once "../controle/conexao.php";
  require_once "../controle/funcoes.php";

  header("Cache-Control: no-cache, no-store, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: 0");

  $idvenda = $_GET['idvenda'] ?? 0;
  if (!$idvenda) {
      die("Venda não encontrada");
  }

  $venda = buscarVendaPorId($conexao, $idvenda);
  if (!$venda) {
      die("Venda não encontrada.");
  }

  $valor = floatval($venda['valor_final']);
  if ($valor <= 0) {
      die("Valor inválido");
  }

  $email = $venda['email_cliente'];

  // Payload pro Node
  $payload = json_encode([
      "valor" => $valor,
      "email" => $email,
      "idvenda" => $idvenda
  ]);

  $ch = curl_init("http://localhost:3000/criar-pix");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

  $response = curl_exec($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  // Log para debug
  file_put_contents('log_pix_node.txt', date('Y-m-d H:i:s') . " - Pedido: $idvenda - Valor: $valor - Email: $email - HTTP: $http_code - Response: $response\n\n", FILE_APPEND);

  $dados = json_decode($response, true);

  if ($http_code !== 200 || !isset($dados["point_of_interaction"]["transaction_data"]["qr_code_base64"])) {
      echo "<pre>Erro no Node: HTTP $http_code\n";
      print_r($dados);
      echo "</pre>";
      die("Erro ao gerar PIX. Verifique o servidor Node.");
  }

  $qr_code = $dados["point_of_interaction"]["transaction_data"]["qr_code_base64"];
  $copia_cola = $dados["point_of_interaction"]["transaction_data"]["qr_code"];
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
  <meta charset="UTF-8">
  <title>Pagamento PIX</title>
  </head>
  <body style="text-align:center; font-family:Arial">
      <h2>Pagamento PIX do Pedido #<?= htmlspecialchars($idvenda) ?></h2>
      <p>Valor: <strong>R$ <?= number_format($valor, 2, ',', '.') ?></strong></p>
      <img src="data:image/png;base64,<?= $qr_code ?>" alt="QR Code PIX" style="width:300px;"><br><br>
      <textarea readonly style="width:300px; height:100px;"><?= $copia_cola ?></textarea><br>
      <small>Escaneie o QR Code ou copie o código acima para pagar.</small>
  </body>
  </html>
  