<?php
require_once "conexao.php";
require_once "funcoes.php";

$idcliente = $_GET['idcliente'];
$valor_final = $_GET['valor_final'];
$data = $_GET['data_compra'];
$observacao = $_GET['observacao'] ?? ''; // caso não venha, usa vazio
$status = $_GET['status'] ?? 'pendente'; // valor padrão

$idproduto = $_GET['idproduto']; // array de IDs de produtos
$quantidade = $_GET['quantidade']; // array associativo [idproduto => qtd]

foreach ($idproduto as $produto) {
    $produtos[] = [$produto, $quantidade[$produto]];
}


// processo de salvamento
$idvenda = salvarVenda($conexao, $valor_final, $observacao, $data, $idcliente, $status);

foreach ($produtos as $p) {
    $valor = buscarValorProduto($conexao, $p[0]);
    salvarItemVenda($conexao, $idvenda, $p[0], $p[1], $valor, $observacao);
}
?>