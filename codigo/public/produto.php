<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

// Pega o ID do produto via GET e valida
$idproduto = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Busca o produto no banco
$produto = buscarProdutoPorId($conexao, $idproduto);

if (!$produto) {
    echo "<p>Produto não encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="./css/observacoes.css">
</head>
<body>

    <div class="produto-container">

        <!-- Imagem -->
        <div class="imagem-card">
            <?php 
            $caminhoImagem = "../controle/fotos/" . htmlspecialchars($produto['foto']);
            if (file_exists($caminhoImagem)) {
                echo '<img src="' . $caminhoImagem . '" alt="' . htmlspecialchars($produto['nome']) . '">';
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
                <button id="btnAdicionais">Adicionais +</button>
                <button id="btnObservacoes">Observações</button>
            </div>

            <!-- Quantidade -->
            <div class="quantidade">
                <button type="button" id="menos">-</button>
                <input type="number" name="quantidade" value="1" min="1" id="qtdInput" readonly>
                <button type="button" id="mais">+</button>
            </div>

            <!-- Ações -->
            <div class="acoes">
                <form action="adicionarCarrinho.php" method="post">
                    <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto'] ?? $produto['id'] ?? 0; ?>">
                    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
                    <input type="hidden" name="valor" value="<?php echo $produto['valor'] ?? 0; ?>">
                    <input type="hidden" name="foto" value="<?php echo htmlspecialchars($produto['foto'] ?? ''); ?>">

                    <input type="hidden" name="quantidade" id="inputQuantidade" value="1">
                    <input type="hidden" name="observacoes" id="inputObservacoes">
                    <button type="submit">Adicionar ao carrinho</button>
                    <br><br>
                </form>

                <form action="finalizarCompra.php" method="post">
                    <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
                    <button type="submit">Finalizar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== Modal de Observações ===== -->
    <div id="modalObservacoes" class="modal">
        <div class="modal-content">
            <h2>Observações Especiais</h2>
            <textarea id="textoObservacoes" placeholder="Ex: tirar cebola, ponto da carne, etc."></textarea>
            <div class="botoes-modal">
                <button class="btn-secundario" id="btnCancelar">Cancelar</button>
                <button id="btnSalvar" style="background:#d62828;color:#fff;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Salvar</button>
            </div>
        </div>
    </div>

    <!-- ===== Modal de Adicionais ===== -->
    <div id="modalAdicionais" class="modal">
        <div class="modal-content">
            <h2>Escolha seus Adicionais</h2>

            <?php
            // Consulta os ingredientes agrupados por categoria
            $sqlCategorias = "SELECT DISTINCT categoria FROM ingrediente ORDER BY categoria ASC";
            $categorias = mysqli_query($conexao, $sqlCategorias);

            while ($cat = mysqli_fetch_assoc($categorias)) {
                echo "<details class='grupo-adicional'>";
                echo "<summary>" . htmlspecialchars($cat['categoria']) . "</summary>";

                $sqlItens = "SELECT idingrediente, nome, valor_unitario FROM ingrediente 
                            WHERE categoria = '" . mysqli_real_escape_string($conexao, $cat['categoria']) . "'";
                $itens = mysqli_query($conexao, $sqlItens);

                while ($item = mysqli_fetch_assoc($itens)) {
                    echo "
                    <div class='adicional-item'>
                        <span>" . htmlspecialchars($item['nome']) . " – R$ " . number_format($item['valor_unitario'], 2, ',', '.') . "</span>
                        <div class='controle-qtd'>
                            <button type='button' class='menos' data-id='{$item['idingrediente']}'>-</button>
                            <input type='number' id='qtd_{$item['idingrediente']}' value='0' min='0' readonly>
                            <button type='button' class='mais' data-id='{$item['idingrediente']}'>+</button>
                        </div>
                    </div>";
                }

                echo "</details>";
            }
            ?>

            <div class="botoes-modal">
                <button class="btn-secundario" id="btnCancelarAdd">Cancelar</button>
                <button id="btnSalvarAdd" style="background:#d62828;color:#fff;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Salvar</button>
            </div>
        </div>
    </div>

    <!-- ===== JavaScript ===== -->
    <script>
        // ===== Quantidade =====
        const menos = document.getElementById('menos');
        const mais = document.getElementById('mais');
        const qtdInput = document.getElementById('qtdInput');
        const inputQuantidade = document.getElementById('inputQuantidade');

        menos.addEventListener('click', () => {
            let valor = parseInt(qtdInput.value);
            if (valor > 1) {
                qtdInput.value = valor - 1;
                inputQuantidade.value = qtdInput.value;
            }
        });

        mais.addEventListener('click', () => {
            let valor = parseInt(qtdInput.value);
            qtdInput.value = valor + 1;
            inputQuantidade.value = qtdInput.value;
        });

        // ===== Modal de Observações =====
        const btnObservacoes = document.getElementById('btnObservacoes');
        const modalObs = document.getElementById('modalObservacoes');
        const btnCancelarObs = document.getElementById('btnCancelar');
        const btnSalvarObs = document.getElementById('btnSalvar');
        const textarea = document.getElementById('textoObservacoes');
        const inputObservacoes = document.getElementById('inputObservacoes');

        btnObservacoes.addEventListener('click', () => {
            modalObs.style.display = 'block';
        });

        btnCancelarObs.addEventListener('click', () => {
            modalObs.style.display = 'none';
        });

        btnSalvarObs.addEventListener('click', () => {
            inputObservacoes.value = textarea.value;
            modalObs.style.display = 'none';
        });

        // ===== Modal de Adicionais =====
        const btnAdicionais = document.getElementById('btnAdicionais');
        const modalAdd = document.getElementById('modalAdicionais');
        const btnCancelarAdd = document.getElementById('btnCancelarAdd');
        const btnSalvarAdd = document.getElementById('btnSalvarAdd');

        btnAdicionais.addEventListener('click', () => {
            modalAdd.style.display = 'block';
        });

        btnCancelarAdd.addEventListener('click', () => {
            modalAdd.style.display = 'none';
        });

        btnSalvarAdd.addEventListener('click', () => {
            modalAdd.style.display = 'none';
        });

        // ===== Fecha modais ao clicar fora =====
        window.addEventListener('click', function(event) {
            if (event.target === modalObs) {
                modalObs.style.display = 'none';
            }
            if (event.target === modalAdd) {
                modalAdd.style.display = 'none';
            }
        });
    </script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== Modal de Adicionais =====
    const btnAdicionais = document.getElementById('btnAdicionais');
    const modalAdicionais = document.getElementById('modalAdicionais');
    const btnCancelarAdd = document.getElementById('btnCancelarAdd');

    if (btnAdicionais && modalAdicionais && btnCancelarAdd) {
        btnAdicionais.addEventListener('click', () => {
            modalAdicionais.style.display = 'block';
        });

        btnCancelarAdd.addEventListener('click', () => {
            modalAdicionais.style.display = 'none';
        });

        // Fechar ao clicar fora do modal
        window.addEventListener('click', (event) => {
            if (event.target === modalAdicionais) {
                modalAdicionais.style.display = 'none';
            }
        });
    }
});
</script>


    <script src="../controle/adicionais.js"></script>

</body>
</html>
