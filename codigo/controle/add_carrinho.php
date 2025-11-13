<?php
session_start();
require_once "conexao.php";
require_once "funcoes.php";

// Verifica se recebeu os dados do formulário
if (!isset($_POST['idproduto'])) {
    echo "Nenhum produto selecionado.";
    exit;
}

// Recebe os dados do produto
$idproduto = intval($_POST['idproduto']);
$nome = $_POST['nome'];
$valor = floatval($_POST['valor']);

// Inicializa a sessão do carrinho, se ainda não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Monta o array base do produto
$item = [
    'idproduto' => $idproduto,
    'nome' => $nome,
    'valor' => $valor,
    'adicionais' => [],
];

// Se houver adicionais selecionados
if (isset($_POST['adicionais']) && is_array($_POST['adicionais'])) {
    $adicionais_ids = $_POST['adicionais'];

    foreach ($adicionais_ids as $idAdicional) {
        $idAdicional = intval($idAdicional);

        // Busca o adicional no banco (para garantir nome e valor atualizados)
        $sql = "SELECT nome, valor_unitario FROM ingrediente WHERE idingrediente = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idAdicional);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $adicional = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);

        if ($adicional) {
            $item['adicionais'][] = [
                'id' => $idAdicional,
                'nome' => $adicional['nome'],
                'valor' => $adicional['valor_unitario']
            ];

            // Soma o valor do adicional ao total do produto
            $item['valor'] += $adicional['valor_unitario'];
        }
    }
}

// Adiciona o item ao carrinho
$_SESSION['carrinho'][] = $item;

// Redireciona para a página do carrinho
header("Location: ../carrinho.php");
exit;
?>
