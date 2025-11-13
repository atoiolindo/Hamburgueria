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
    die("Valor inválido para pagamento: $valor");
}

$access_token = "APP_USR-3238476273840575-111217-affc2ee9b4da830be6b7734c12cf4a19-2986569358";  // Mude para token de teste se testar sandbox

$payload = [
    "transaction_amount" => $valor + (rand(1, 999) / 10000),  // Adiciona centavos aleatórios para diferenciar
    "description" => "Pedido #$idvenda - " . uniqid() . " - " . time(),
    "external_reference" => "pedido_$idvenda_" . uniqid() . "_" . time(),
    "payment_method_id" => "pix",
    "payer" => [
        "email" => $venda['email_cliente'] . rand(1, 1000) . "@temp.com",  // Email único temporário (teste)
        "first_name" => "Cliente",
        "last_name" => "Teste"
    ],
    "notification_url" => "https://seusite.com/webhook.php"
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.mercadopago.com/v1/payments",  // Mude para sandbox se testar
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token",
        "Content-Type: application/json",
        "X-Idempotency-Key: " . md5(uniqid(mt_rand(), true) . microtime() . $idvenda . $valor)    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

file_put_contents('log_pix_debug.txt', date('Y-m-d H:i:s') . " - Iniciando - Payload: " . json_encode($payload) . "\n", FILE_APPEND);

$response = curl_exec($curl);
$http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$dados = json_decode($response, true);

file_put_contents('log_pix_debug.txt', "HTTP: $http - Resposta: " . print_r($dados, true) . " - Response raw: $response\n\n", FILE_APPEND);

if ($http >= 400) {
    echo "<pre>Erro HTTP $http\n";
    print_r($dados);
    echo "</pre>";
    die("Erro ao gerar PIX.");
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