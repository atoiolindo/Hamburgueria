<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data["data"]["id"])) {
    $id_pagamento = $data["data"]["id"];

    $access_token = "APP_USR-3238476273840575-111217-affc2ee9b4da830be6b7734c12cf4a19-2986569358";
    $url = "https://api.mercadopago.com/v1/payments/" . $id_pagamento;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $access_token"]);
    $response = curl_exec($ch);
    curl_close($ch);

    $pagamento = json_decode($response, true);

    if ($pagamento["status"] === "approved") {
        $descricao = $pagamento["description"]; // Ex: "Pedido #12"
        preg_match('/#(\d+)/', $descricao, $matches);
        $idvenda = $matches[1] ?? 0;

        if ($idvenda) {
            atualizarStatusVenda($conexao, $idvenda, "pago");
        }
    }
}
