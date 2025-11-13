<?php
require_once "conexao.php";
require_once "funcoes.php";

session_start(); // Caso queira vincular o cliente depois

// Dados do formulário
$idproduto = isset($_POST['idproduto']) ? intval($_POST['idproduto']) : 0;
$adicionais = isset($_POST['adicionais']) ? $_POST['adicionais'] : [];
$observacao = isset($_POST['observacao']) ? trim($_POST['observacao']) : "";

// Validação
if ($idproduto <= 0) {
    die("Produto inválido.");
}

// Busca o valor do produto
$sqlProduto = "SELECT valor FROM produto WHERE idproduto = ?";
$stmt = mysqli_prepare($conexao, $sqlProduto);
mysqli_stmt_bind_param($stmt, "i", $idproduto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$produto) {
    die("Produto não encontrado.");
}

$valor_final = $produto['valor'];

// Soma o valor dos adicionais
if (!empty($adicionais)) {
    $ids = implode(',', array_map('intval', $adicionais));
    $sqlAdd = "SELECT valor_unitario FROM armazenamento WHERE idingrediente IN ($ids)";
    $res = mysqli_query($conexao, $sqlAdd);
    while ($row = mysqli_fetch_assoc($res)) {
        $valor_final += $row['valor_unitario'];
    }
}

// Cria a venda
$data = date("Y-m-d");
$idcliente = 1; // pode mudar para $_SESSION['idcliente'] depois
$status = "pendente";

$sqlVenda = "INSERT INTO venda (valor_final, observacao, data, idcliente, status) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sqlVenda);
mysqli_stmt_bind_param($stmt, "dssis", $valor_final, $observacao, $data, $idcliente, $status);
mysqli_stmt_execute($stmt);
$idvenda = mysqli_insert_id($conexao);
mysqli_stmt_close($stmt);

// Insere o item principal da venda
$sqlItem = "INSERT INTO item_venda (idvenda, idproduto, quantidade, valor, observacao) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sqlItem);
$quantidade = 1;
mysqli_stmt_bind_param($stmt, "iiids", $idvenda, $idproduto, $quantidade, $valor_final, $observacao);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Registra adicionais como novos itens (se quiser somar separadamente)
if (!empty($adicionais)) {
    foreach ($adicionais as $idAdd) {
        $sqlAddItem = "SELECT nome, valor_unitario FROM armazenamento WHERE idingrediente = ?";
        $stmt = mysqli_prepare($conexao, $sqlAddItem);
        mysqli_stmt_bind_param($stmt, "i", $idAdd);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $add = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);

        if ($add) {
            $sqlItemAdd = "INSERT INTO item_venda (idvenda, idproduto, quantidade, valor, observacao) VALUES (?, ?, ?, ?, ?)";
            $descricaoAdd = "Adicional: " . $add['nome'];
            $qtd = 1;
            mysqli_stmt_bind_param($stmt, "iiids", $idvenda, $idproduto, $qtd, $add['valor_unitario'], $descricaoAdd);
            $stmt = mysqli_prepare($conexao, $sqlItemAdd);
            mysqli_stmt_bind_param($stmt, "iiids", $idvenda, $idproduto, $qtd, $add['valor_unitario'], $descricaoAdd);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

// Redireciona para o carrinho
header("Location: ../public/carrinho.php?msg=Produto adicionado com sucesso");
exit;
?>
