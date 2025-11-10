<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

if ($pesquisa != '') {
    $resultados = pesquisar($conexao, $pesquisa);
} else {
    $resultados = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="./css/pesquisa.css">
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


</head>
<body>

    <form class="barra-pesquisa" action="pesquisa.php" method="get">
        <button type="submit" title="Pesquisar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <input type="text" name="pesquisa" placeholder="Pesquisar">

    </form>


    <h2>Resultados para: "<?php echo htmlspecialchars($pesquisa); ?>"</h2>

    <?php
    if ($pesquisa == '') {
        echo '<p>Digite algo para pesquisar.</p>';
    } elseif (count($resultados) == 0) {
        echo '<p>Nenhum produto encontrado.</p>';
    } else {
        echo '<div class="container-produtos">';
        foreach ($resultados as $item) {
            echo '<div class="produto">';
            echo '<img src="../imagens/' . htmlspecialchars($item['foto']) . '" alt="' . htmlspecialchars($item['nome']) . '">';
            echo '<h3>' . htmlspecialchars($item['nome']) . '</h3>';
            echo '<p class="preco">R$ ' . number_format($item['valor'], 2, ',', '.') . '</p>';
            echo '<p>' . htmlspecialchars($item['descricao']) . '</p>';
            echo '<a class="btn-carrinho" href="adicionarCarrinho.php?id=' . $item['idproduto'] . '">Adicionar ao Carrinho</a>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>

    <a class="voltar" href="index.php">← Voltar</a>

</body>
</html>
