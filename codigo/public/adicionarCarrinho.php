<?php
session_start();
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$idproduto = ($_POST['idproduto']);
$quantidade = ($_POST['quantidade']);
$observacoes = ($_POST['observacoes'] ?? '');

$produto = buscarProdutoPorId($conexao, $idproduto);

if (!$produto) {
    echo json_encode(["success" => false, "message" => "Produto não encontrado."]);
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$idproduto])) {
    $_SESSION['carrinho'][$idproduto]['quantidade'] += $quantidade;
} else {
    $_SESSION['carrinho'][$idproduto] = [
        'idproduto' => $produto['idproduto'],
        'nome' => $produto['nome'],
        'valor' => $produto['valor'],
        'foto' => $produto['foto'],
        'quantidade' => $quantidade,
        'observacoes' => $observacoes
    ];
}

$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['quantidade'] * $item['valor'];
}

echo json_encode([
    "success" => true,
    "carrinho" => $_SESSION['carrinho'],
    "total" => ($total, 2, ',', '.')
]);
exit;
