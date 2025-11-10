<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$idproduto = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produto = buscarProdutoPorId($conexao, $idproduto);
if (!$produto) { echo "<p>Produto não encontrado.</p>"; exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($produto['nome']); ?></title>
<link rel="stylesheet" href="./css/observacoes.css">
<style>
/* Estilos mínimos para modais (copie para seu CSS depois) */
.modal { display:none; position:fixed; top:0; left:0; right:0; bottom:0; align-items:center; justify-content:center; background:rgba(0,0,0,0.4); z-index:1000; }
.modal-content { background:#fff; padding:16px; border-radius:8px; max-width:520px; width:90%; box-shadow:0 6px 18px rgba(0,0,0,.2); }
.botoes-modal { display:flex; justify-content:flex-end; gap:8px; margin-top:12px; }
.controle-qtd button{ padding:4px 8px; cursor:pointer; }
.controle-qtd input{ width:44px; text-align:center; }
.grupo-adicional{ margin-bottom:8px; border-radius:6px; padding:8px; background:#f7f7f7; }
.adicional-item{ display:flex; justify-content:space-between; align-items:center; padding:6px 0; }
</style>
</head>
<body>

<div class="produto-container">
  <div class="imagem-card">
    <?php $caminhoImagem = "../controle/fotos/" . htmlspecialchars($produto['foto']);
    if (file_exists($caminhoImagem)) echo '<img src="'.$caminhoImagem.'" alt="'.htmlspecialchars($produto['nome']).'">'; ?>
  </div>

  <div class="detalhes">
    <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
    <h3><?php echo htmlspecialchars($produto['nome_real']); ?></h3>
    <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
    <p><strong>R$ <?php echo number_format($produto['valor'],2,',','.'); ?></strong></p>

    <div class="botoes-opcoes">
      <button id="btnAdicionais">Adicionais +</button>
      <button id="btnObservacoes">Observações</button>
    </div>

    <div class="quantidade">
      <button type="button" id="menos">-</button>
      <input type="number" id="qtdInput" name="quantidade" value="1" min="1" readonly>
      <button type="button" id="mais">+</button>
    </div>

    <div class="acoes">
      <form action="adicionarCarrinho.php" method="post" id="formCarrinho">
        <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>">
        <input type="hidden" name="valor" value="<?php echo $produto['valor']; ?>">
        <input type="hidden" name="foto" value="<?php echo htmlspecialchars($produto['foto']); ?>">
        <input type="hidden" name="quantidade" id="inputQuantidade" value="1">
        <input type="hidden" name="observacoes" id="inputObservacoes">
        <!-- campo adicionais será criado dinamicamente -->
        <button type="submit">Adicionar ao carrinho</button>
      </form>

      <form action="finalizarCompra.php" method="post">
        <input type="hidden" name="idproduto" value="<?php echo $produto['idproduto']; ?>">
        <button type="submit">Finalizar</button>
      </form>
    </div>
  </div>
</div>

<!-- Modal Observações -->
<div id="modalObservacoes" class="modal">
  <div class="modal-content">
    <h2>Observações Especiais</h2>
    <textarea id="textoObservacoes" placeholder="Ex: tirar cebola, ponto da carne, etc." style="width:100%;min-height:80px"></textarea>
    <div class="botoes-modal">
      <button id="btnCancelarObs" class="btn-secundario" type="button">Cancelar</button>
      <button id="btnSalvarObs" type="button" style="background:#d62828;color:#fff;border:none;padding:8px 12px;border-radius:6px;">Salvar</button>
    </div>
  </div>
</div>

<!-- Modal Adicionais -->
<div id="modalAdicionais" class="modal">
  <div class="modal-content">
    <h2>Escolha seus Adicionais</h2>

    <?php
    // Puxa categorias (se coluna categoria existir na sua tabela armazenamento/ingrediente)
    $sqlCategorias = "SELECT DISTINCT categoria FROM ingrediente ORDER BY categoria ASC";
    $categorias = mysqli_query($conexao, $sqlCategorias);
    while ($cat = mysqli_fetch_assoc($categorias)) {
      $categoria = $cat['categoria'];
      echo "<details class='grupo-adicional'><summary>".htmlspecialchars($categoria)."</summary>";
      $sqlItens = "SELECT idingrediente, nome, valor_unitario FROM ingrediente WHERE categoria = '".mysqli_real_escape_string($conexao,$categoria)."' ORDER BY nome";
      $itens = mysqli_query($conexao, $sqlItens);
      while ($item = mysqli_fetch_assoc($itens)) {
        $id = $item['idingrediente'];
        $nome = htmlspecialchars($item['nome']);
        $preco = number_format($item['valor_unitario'],2,',','.');
        echo "<div class='adicional-item'>
                <span>{$nome} – R$ {$preco}</span>
                <div class='controle-qtd'>
                  <button type='button' class='menos' data-id='{$id}'>-</button>
                  <input type='number' id='qtd_{$id}' value='0' min='0' readonly>
                  <button type='button' class='mais' data-id='{$id}'>+</button>
                </div>
              </div>";
      }
      echo "</details>";
    }
    ?>

    <div class="botoes-modal">
      <button id="btnCancelarAdd" class="btn-secundario" type="button">Cancelar</button>
      <button id="btnSalvarAdd" type="button" style="background:#d62828;color:#fff;border:none;padding:8px 12px;border-radius:6px;">Salvar</button>
    </div>
  </div>
</div>

<!-- ===== JS: tudo em uma seção, roda após DOM ready ===== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // quantidade principal
  const menos = document.getElementById('menos');
  const mais = document.getElementById('mais');
  const qtdInput = document.getElementById('qtdInput');
  const inputQuantidade = document.getElementById('inputQuantidade');

  menos.addEventListener('click', () => {
    let v = parseInt(qtdInput.value||'1');
    if (v>1) { v--; qtdInput.value = v; inputQuantidade.value = v; }
  });
  mais.addEventListener('click', () => {
    let v = parseInt(qtdInput.value||'1'); v++; qtdInput.value = v; inputQuantidade.value = v;
  });

  // observações
  const btnObs = document.getElementById('btnObservacoes');
  const modalObs = document.getElementById('modalObservacoes');
  const btnCancelarObs = document.getElementById('btnCancelarObs');
  const btnSalvarObs = document.getElementById('btnSalvarObs');
  const textareaObs = document.getElementById('textoObservacoes');
  const inputObs = document.getElementById('inputObservacoes');

  btnObs.addEventListener('click', () => modalObs.style.display = 'flex');
  btnCancelarObs.addEventListener('click', () => modalObs.style.display = 'none');
  btnSalvarObs.addEventListener('click', () => {
    inputObs.value = textareaObs.value;
    modalObs.style.display = 'none';
  });

  // adicionais: abrir/fechar
  const btnAdd = document.getElementById('btnAdicionais');
  const modalAdd = document.getElementById('modalAdicionais');
  const btnCancelarAdd = document.getElementById('btnCancelarAdd');
  const btnSalvarAdd = document.getElementById('btnSalvarAdd');
  btnAdd.addEventListener('click', () => modalAdd.style.display = 'flex');
  btnCancelarAdd.addEventListener('click', () => modalAdd.style.display = 'none');

  // fechar ao clicar fora (ambos)
  window.addEventListener('click', (e) => {
    if (e.target === modalObs) modalObs.style.display = 'none';
    if (e.target === modalAdd) modalAdd.style.display = 'none';
  });

  // controles + e - dos adicionais (delegação)
  document.addEventListener('click', (e) => {
    if (e.target.matches('.adicional-item .mais') || e.target.matches('.mais')) {
      const id = e.target.getAttribute('data-id');
      const input = document.getElementById('qtd_' + id);
      if (input) input.value = String(Math.max(0, parseInt(input.value||'0') + 1));
    }
    if (e.target.matches('.adicional-item .menos') || e.target.matches('.menos')) {
      const id = e.target.getAttribute('data-id');
      const input = document.getElementById('qtd_' + id);
      if (input) input.value = String(Math.max(0, parseInt(input.value||'0') - 1));
    }
  });

  // salvar adicionais: cria campo hidden 'adicionais' no form com resumo (JSON)
  btnSalvarAdd.addEventListener('click', () => {
    const selecionados = [];
    document.querySelectorAll('[id^="qtd_"]').forEach(inp => {
      const qtd = parseInt(inp.value||'0');
      if (qtd > 0) {
        const id = inp.id.replace('qtd_','');
        const nome = inp.closest('.adicional-item').querySelector('span').textContent.trim();
        selecionados.push({ id, nome, quantidade: qtd });
      }
    });

    // encontra/cria input hidden no form
    const form = document.getElementById('formCarrinho');
    if (!form) { console.warn('Form carrinho não encontrado'); modalAdd.style.display='none'; return; }
    let inputAd = form.querySelector('input[name="adicionais"]');
    if (!inputAd) {
      inputAd = document.createElement('input');
      inputAd.type = 'hidden';
      inputAd.name = 'adicionais';
      form.appendChild(inputAd);
    }
    inputAd.value = JSON.stringify(selecionados);

    // opcional: atualiza visual (alert) — pode remover
    if (selecionados.length === 0) {
      // nada selecionado
    } else {
      // console.log(selecionados);
    }

    modalAdd.style.display = 'none';
  });

});
</script>

</body>
</html>
