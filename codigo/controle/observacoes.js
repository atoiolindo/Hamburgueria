let observacao = "";

// Abre o popup
function abrirPopup() {
  document.getElementById("overlay").style.display = "flex";
  document.getElementById("obsTexto").value = observacao;
  document.body.style.overflow = "hidden"; // evita rolagem no fundo
}

// Fecha o popup
function fecharPopup() {
  document.getElementById("overlay").style.display = "none";
  document.body.style.overflow = "auto";
}

// Salva a observação digitada
function salvarObs() {
  observacao = document.getElementById("obsTexto").value;
  localStorage.setItem("observacao_temp", observacao);
  fecharPopup();
}

// Envia a observação junto ao formulário
function enviarObs(form) {
  const obs = localStorage.getItem("observacao_temp") || "";
  const input = form.querySelector("[name='observacao']");
  input.value = obs;
}

// Controle de quantidade
function alterarQtd(valor) {
  const input = document.getElementById("qtdInput");
  let atual = parseInt(input.value);
  atual = Math.max(1, atual + valor);
  input.value = atual;
  document.getElementById("qtdInputHidden").value = atual;
}
