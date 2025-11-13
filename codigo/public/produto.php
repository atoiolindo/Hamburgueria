<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$idproduto = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($idproduto <= 0) {
    die("Produto inválido!");
}

// Busca informações do produto
$sql = "SELECT nome, descricao, valor, foto FROM produto WHERE idproduto = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $idproduto);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);

if (!$produto) {
    die("Produto não encontrado!");
}

// Busca adicionais disponíveis
$adicionais = buscarAdicionaisDisponiveis($conexao, $idproduto);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="css/produto.css">
    <link rel="icon" href="./assets/logo1.png" type="image/x-icon">
</head>

<body>
    <div class="produto-container">
        <div class="produto-imagem">
            <img src="assets/<?php echo htmlspecialchars($produto['foto']); ?>" 
                 alt="<?php echo htmlspecialchars($produto['nome']); ?>">
        </div>

        <div class="produto-info">
            <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
            <p class="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></p>
            <p class="preco">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>

            <div class="botoes">
                <button id="btnAdicionais">Adicionais +</button>
                <button id="btnObservacoes">Observações</button>
            </div>
        </div>
    </div>

    <!-- POP-UP ADICIONAIS -->
    <div id="popupAdicionais" class="popup-overlay">
        <div class="popup-content">
            <h2>Adicionais</h2>
            <form id="formAdicionais">
                <?php if (!empty($adicionais)): ?>
                    <?php foreach ($adicionais as $add): ?>
                        <label>
                            <input type="checkbox" name="adicionais[]" value="<?php echo $add['idingrediente']; ?>">
                            <?php echo htmlspecialchars($add['nome']); ?> - R$ <?php echo number_format($add['valor_unitario'], 2, ',', '.'); ?>
                        </label><br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Sem adicionais disponíveis.</p>
                <?php endif; ?>
                <button type="button" class="btnCancelar" id="btnCancelarAdd">Fechar</button>
            </form>
        </div>
    </div>

    <!-- POP-UP OBSERVAÇÕES -->
    <div id="popupObservacoes" class="popup-overlay">
        <div class="popup-content">
            <h2>Observações</h2>
            <form id="formObservacoes">
                <textarea name="observacao" placeholder="Ex: tirar cebola, ponto da carne, etc." maxlength="200"></textarea>
                <button type="button" class="btnCancelar" id="btnCancelarObs">Fechar</button>
            </form>
        </div>
    </div>

    <div class="finalizar-container">
        <button id="btnFinalizar">Finalizar Produto</button>
    </div>

    <script>
        const popupAdd = document.getElementById('popupAdicionais');
        const popupObs = document.getElementById('popupObservacoes');
        const btnAdd = document.getElementById('btnAdicionais');
        const btnObs = document.getElementById('btnObservacoes');
        const fecharAdd = document.getElementById('btnCancelarAdd');
        const fecharObs = document.getElementById('btnCancelarObs');

        btnAdd.onclick = () => popupAdd.style.display = 'flex';
        fecharAdd.onclick = () => popupAdd.style.display = 'none';
        btnObs.onclick = () => popupObs.style.display = 'flex';
        fecharObs.onclick = () => popupObs.style.display = 'none';
    </script>
</body>

</html>
