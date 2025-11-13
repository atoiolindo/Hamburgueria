<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$idvenda = $_GET['idvenda'] ?? 0;
if (!$idvenda) {
    die("Venda não encontrada");
}

$venda = buscarVendaPorId($conexao, $idvenda);
if (!$venda) {
    die("Venda não encontrada.");
}

$valor = floatval($venda['valor_final']); // ✅ Corrigido

$access_token = "TEST-3238476273840575-111217-6396ee4a40ca9d984b7d513162c5d4cc-2986569358";

$payload = [
    "transaction_amount" => $valor,
    "description" => "Pedido #$idvenda",
    "payment_method_id" => "pix",
    "payer" => [
        "email" => "cliente@example.com",
        "first_name" => "Cliente",
        "last_name" => "Teste"
    ],
    "notification_url" => "https://6d102f5b31ab.ngrok-free.app/public/webhook.php"
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.mercadopago.com/v1/payments",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token",
        "Content-Type: application/json",
        "X-Idempotency-Key: " . md5('pix_' . $idvenda . microtime(true))
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "transaction_amount" => $valor,
        "description" => "Pedido #$idvenda - " . uniqid(),
        "payment_method_id" => "pix",
        "payer" => [
            "email" => "cliente@example.com",
            "first_name" => "Cliente",
            "last_name" => "Teste"
        ],
        "notification_url" => "https://6d102f5b31ab.ngrok-free.app/public/webhook.php"
    ])
]);


$response = curl_exec($curl);
$http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$dados = json_decode($response, true);

// 🔎 debug útil
if ($http >= 400) {
    echo "<pre>Erro HTTP $http\n";
    print_r($dados);
    echo "</pre>";
    die("❌ Erro ao gerar PIX.");
}

if (isset($dados["point_of_interaction"]["transaction_data"]["qr_code_base64"])) {
    $qr_code = $dados["point_of_interaction"]["transaction_data"]["qr_code_base64"];
    $copia_cola = $dados["point_of_interaction"]["transaction_data"]["qr_code"];
} else {
    echo "<pre>";
    print_r($dados);
    echo "</pre>";
    die("Erro ao gerar PIX");
}
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
