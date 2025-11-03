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
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff8f6;
            padding: 30px;
        }

        .produto-container {
            display: flex;
            align-items: flex-start;
            gap: 40px;
            flex-wrap: wrap;
        }

        .imagem img {
            border-radius: 16px;
            max-width: 400px;
            height: auto;
        }

        .detalhes h1 {
            margin-bottom: 5px;
        }

        .detalhes h3 {
            margin-top: 0;
            color: #555;
        }

        .botoes-opcoes button {
            background-color: #d62828;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 14px;
        }

        .botoes-opcoes button:hover {
            background-color: #a71c1c;
        }

        .quantidade {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 15px 0;
        }

        .quantidade button {
            background-color: #d62828;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .acoes button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-right: 10px;
        }

        /* ===== Modal ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal textarea {
            width: 100%;
            height: 120px;
            resize: none;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
        }

        .btn-secundario {
            background-color: #ccc;
            color: #333;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-secundario:hover {
            background-color: #aaa;
        }

        .botoes-modal {
            text-align: right;
            margin-top: 10px;
        }
    </style>
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
