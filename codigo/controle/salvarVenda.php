<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

// Recebe dados da venda
$idvenda = $_GET['id'] ?? 0; // 0 = nova venda
$idcliente = $_POST['idcliente'] ?? null;

if (!$idcliente) {
    die("Erro: Cliente não informado.");
}
$valor_final = $_POST['valor_final'] ?? 0;
$data        = $_POST['data_compra'] ?? date('Y-m-d');
$observacao  = $_POST['observacao'] ?? '';
$status      = $_POST['status'] ?? 'pendente';

// Produtos e quantidades
$idprodutos  = $_POST['idproduto'] ?? [];
$quantidades = $_POST['quantidade'] ?? [];

// Monta array [idproduto, quantidade]
$produtos = [];
foreach ($idprodutos as $produto) {
    $produtos[] = [$produto, $quantidades[$produto] ?? 1];
}

if ($idvenda == 0) {
    // Nova venda
    $idvenda = salvarVenda($conexao, $valor_final, $observacao, $data, $idcliente, $status);

    if (!$idvenda) {
        die("Erro ao criar a venda. Verifique o cliente e dados.");
    }
    
    // Depois usa $idvenda corretamente
    foreach ($produtos as $p) {
        $valor_produto = buscarValorProduto($conexao, $p[0]);
        salvarItemVenda($conexao, $idvenda, $p[0], $p[1], $valor_produto, $observacao);
    }

} else {
    // Atualiza venda existente
    editarVenda($conexao, $valor_final, $observacao, $data, $idcliente, $status, $idvenda);

    // Remove itens antigos
    $sql_del = "DELETE FROM item_venda WHERE idvenda = ?";
    $stmt = $conexao->prepare($sql_del);
    $stmt->bind_param("i", $idvenda);
    $stmt->execute();

    // Insere itens novos
    foreach ($produtos as $p) {
        $valor_produto = buscarValorProduto($conexao, $p[0]);
        salvarItemVenda($conexao, $idvenda, $p[0], $p[1], $valor_produto, $observacao);
    }
}

header("Location: ../public/index.php");
exit;
?>