<?php
$idvenda = $_GET['idvenda'] ?? 0;
$venda = buscarVendaPorId($conexao, $idvenda);
$valor = floatval($venda['valor_final']);
$email = $venda['email_cliente'];

// Dados para enviar pro Node
$payload = json_encode([
    "valor" => $valor,
    "email" => $email,
    "idvenda" => $idvenda
]);

$ch = curl_init("http://localhost:3000/criar-pix");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$response = curl_exec($ch);
curl_close($ch);

$dados = json_decode($response, true);

if (!isset($dados["point_of_interaction"]["transaction_data"]["qr_code_base64"])) {
    die("Erro ao gerar PIX");
}

$qr_code = $dados["point_of_interaction"]["transaction_data"]["qr_code_base64"];
$copia_cola = $dados["point_of_interaction"]["transaction_data"]["qr_code"];
?>
