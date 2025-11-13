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

$valor = floatval($venda['valor_final']);

$access_token = "TEST-3238476273840575-111217-6396ee4a40ca9d984b7d513162c5d4cc-2986569358";

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.mercadopago.com/v1/payments",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token",
        "Content-Type: application/json",
        "X-Idempotency-Key: " . uniqid('', true) // ✅ obrigatório
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "transaction_amount" => ($valor),
        "description" => "Pedido #" . $idvenda,
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
curl_close($curl);

$dados = json_decode($response, true);

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
    <h2>Pagamento PIX do Pedido #<?= $idvenda ?></h2>
    <p>Valor: <strong>R$ <?= number_format($valor, 2, ',', '.') ?></strong></p>

    <img src="data:image/png;base64,<?= $qr_code ?>" alt="QR Code PIX" style="width:300px;"><br><br>
    <textarea readonly style="width:300px; height:100px;"><?= $copia_cola ?></textarea><br>
    <small>Escaneie o QR Code ou copie o código acima para pagar.</small>
</body>
</html>
