<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

// Pega o ID do produto via GET e valida
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Busca o produto no banco
$produto = buscarProdutoPorId($conexao, $id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="produto-container">

        <!-- Imagem -->
        <div class="imagem">
            <?php 
            $caminhoImagem = "../controle/fotos/" . htmlspecialchars($produto['foto']);
            if (file_exists($caminhoImagem)) {
                echo '<img src="' . $caminhoImagem . '" alt="' . htmlspecialchars($produto['nome']) . '" width="400">';
            }
            ?>
        </div>

        <!-- Informações -->
        <div class="detalhes">
            <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
            <h3><?php echo htmlspecialchars($produto['nome_real']); ?></h3>
            <p><?php echo htmlspecialchars($produto['descricao']); ?></p>

            <p><strong>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></strong></p>

            <!-- Botões -->
            <div class="botoes-opcoes">
                <button>Adicionais +</button>
                <button>Observações</button>
            </div>

            <!-- Quantidade -->
            <div class="quantidade">
                <button>-</button>
                <input type="number" name="quantidade" value="1" min="1">
                <button>+</button>
            </div>

            <!-- Ações -->
            <div class="acoes">
                <form action="adicionar_carrinho.php" method="post">
                    <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
                    <input type="hidden" name="quantidade" value="1" id="qtdInput">
                    <button type="submit">Adicionar ao carrinho</button>
                </form>

                <form action="finalizar_compra.php" method="post">
                    <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
                    <button type="submit">Finalizar</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>