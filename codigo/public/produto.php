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
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="./css/observacoes.css">
</head>
<body>

    <div class="produto-container">

        <!-- Imagem -->
        <div class="imagem">
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
                <form action="adicionar_carrinho.php" method="post">
                    <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
                    <input type="hidden" name="quantidade" id="inputQuantidade" value="1">
                    <input type="hidden" name="observacoes" id="inputObservacoes">
                    <button type="submit">Adicionar ao carrinho</button>
                </form>

                <form action="finalizar_compra.php" method="post">
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
        const modal = document.getElementById('modalObservacoes');
        const btnCancelar = document.getElementById('btnCancelar');
        const btnSalvar = document.getElementById('btnSalvar');
        const textarea = document.getElementById('textoObservacoes');
        const inputObservacoes = document.getElementById('inputObservacoes');

        btnObservacoes.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        btnCancelar.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        btnSalvar.addEventListener('click', () => {
            inputObservacoes.value = textarea.value;
            modal.style.display = 'none';
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>
</html>
