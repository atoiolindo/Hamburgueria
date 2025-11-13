<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";
session_start();

// Valida ID
if (!isset($_GET['id'])) {
    die("Produto não especificado.");
}
$idproduto = intval($_GET['id']);

// Busca produto
$sql = "SELECT * FROM produto WHERE idproduto = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $idproduto);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
if (!$resultado || mysqli_num_rows($resultado) === 0) {
    die("Produto não encontrado.");
}
$produto = mysqli_fetch_assoc($resultado);

// Busca adicionais (função em funcoes.php)
$adicionais = buscarAdicionaisDisponiveis($conexao, $idproduto);

// --- Determina src da imagem ---
// Usuário disse que as imagens ficam em "assets/" (relativo a public/)
$foto_filename = trim((string)($produto['foto'] ?? ''));

// caminho absoluto no servidor para checagem
$server_candidate = __DIR__ . '/assets/' . $foto_filename;

if ($foto_filename !== '' && file_exists($server_candidate)) {
    // usar caminho relativo para o browser
    $img_src = 'assets/' . rawurlencode($foto_filename);
} elseif ($foto_filename !== '' && (filter_var($foto_filename, FILTER_VALIDATE_URL))) {
    // se no DB for uma URL completa, usa ela
    $img_src = $foto_filename;
} else {
    // placeholder inline SVG (não precisa arquivo)
    $img_src = 'data:image/svg+xml;base64,' . base64_encode(
        '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450"><rect width="100%" height="100%" fill="#f3f3f3"/><text x="50%" y="50%" font-size="24" fill="#999" dominant-baseline="middle" text-anchor="middle">Sem imagem</text></svg>'
    );
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($produto['nome'] ?? 'Produto'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS esperado em ../css/produto.css -->
    <link rel="stylesheet" href="css/produto.css">
</head>
<body>

<div class="produto-container">
    <div class="produto-imagem">
        <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars((string)$produto['nome'], ENT_QUOTES); ?>">
    </div>

    <div class="produto-info">
        <h1><?php echo htmlspecialchars($produto['nome'] ?? 'Produto'); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($produto['descricao'] ?? '')); ?></p>
        <p class="preco">R$ <?php echo number_format((float)($produto['valor'] ?? 0), 2, ',', '.'); ?></p>

        <button id="btnAdicionais" class="btn-adc">Adicionais +</button>

        <form id="formCarrinho" action="../controle/add_carrinho.php" method="POST">
            <input type="hidden" name="idproduto" value="<?php echo intval($idproduto); ?>">
            <input type="hidden" name="nome" value="<?php echo htmlspecialchars((string)$produto['nome'], ENT_QUOTES); ?>">
            <input type="hidden" name="valor" value="<?php echo number_format((float)($produto['valor'] ?? 0), 2, '.', ''); ?>">

            <!-- popup de adicionais está dentro do form para os checkboxes serem enviados -->
            <div id="popupAdicionais" class="popup" style="display:none;">
                <div class="popup-content">
                    <button type="button" id="fecharPopup" class="fechar">&times;</button>
                    <h2>Escolha até 10 adicionais</h2>

                    <div class="adicionais-list">
                        <?php if (!empty($adicionais)): ?>
                            <?php foreach ($adicionais as $add): 
                                // vindo de armazenamento: idingrediente, nome, valor_unitario
                                $id = $add['idingrediente'] ?? $add['id'] ?? null;
                                $nome = $add['nome'] ?? $add['descricao'] ?? '';
                                $valor = $add['valor_unitario'] ?? $add['valor'] ?? 0;
                            ?>
                                <div class="adicional-item">
                                    <label>
                                        <input type="checkbox" class="check-adicional"
                                               name="adicionais[]"
                                               value="<?php echo intval($id); ?>"
                                               data-valor="<?php echo number_format((float)$valor, 2, '.', ''); ?>">
                                        <?php echo htmlspecialchars((string)$nome); ?> — R$ <?php echo number_format((float)$valor, 2, ',', '.'); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Nenhum adicional disponível.</p>
                        <?php endif; ?>
                    </div>

                    <div class="botoes-popup">
                        <button type="submit" class="btn-confirmar">Adicionar ao carrinho</button>
                        <button type="button" id="cancelarPopup" class="btn-cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
            <!-- fim popup -->
        </form>
    </div>
</div>

<script>
// elementos
const popup = document.getElementById('popupAdicionais');
const btnOpen = document.getElementById('btnAdicionais');
const btnClose = document.getElementById('fecharPopup');
const btnCancel = document.getElementById('cancelarPopup');
const maxAdicionais = 10;

// abrir
btnOpen.addEventListener('click', () => {
    popup.style.display = 'flex';
    document.body.style.overflow = 'hidden';
});

// fechar
if (btnClose) btnClose.addEventListener('click', closePopup);
if (btnCancel) btnCancel.addEventListener('click', closePopup);
window.addEventListener('click', (e) => { if (e.target === popup) closePopup(); });

function closePopup(){
    popup.style.display = 'none';
    document.body.style.overflow = '';
}

// limitar a 10 seleções
function bindLimite(){
    const checks = document.querySelectorAll('.check-adicional');
    checks.forEach(chk => {
        chk.addEventListener('change', function(){
            const marcados = document.querySelectorAll('.check-adicional:checked');
            if (marcados.length > maxAdicionais) {
                this.checked = false;
                alert('Você só pode escolher até ' + maxAdicionais + ' adicionais.');
            }
        });
    });
}
bindLimite();
</script>

</body>
</html>
