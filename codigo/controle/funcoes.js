function calcular() {
  let total = 0;

  document.querySelectorAll("input[type=checkbox][id^='marcado_']").forEach(cb => {
    if (cb.checked) {
      let id = cb.value;
      let preco = parseFloat(document.getElementById('preco_' + id).innerText) || 0;
      let qtd = parseFloat(document.getElementById('quantidade_' + id).value) || 0;
      total += preco * qtd;
    }
  });

  if (document.getElementById('valor_final')) {
    document.getElementById('valor_final').value = total.toFixed(2);
  }
  if (document.getElementById('mostrar_total')) {
    document.getElementById('mostrar_total').innerText = total.toFixed(2);
  }
}


$(document).ready(function() {
  $("form").on("submit", function(e) {
    let data = $("#data").val();
    if (data && data.trim() === "") {
      alert("⚠️ Por favor, selecione a data da venda.");
      e.preventDefault();
      return false;
    }
  });
});


function editarTelefone() {
  const input = document.getElementById('telefone');
  if (input) {
    input.removeAttribute('readonly');
    input.focus();
  }
}

function editarUsuario() {
  const input = document.getElementById('nome');
  if (input) {
    input.removeAttribute('readonly');
    input.focus();
  }
}


const cartSidebar = document.getElementById('cart-sidebar');
const overlay = document.getElementById('overlay');
const cartItemsContainer = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');
const openCartBtn = document.getElementById('open-cart');
const closeCartBtn = document.getElementById('close-cart');

let cart = JSON.parse(localStorage.getItem('cart')) || [];


const salvarEnderecoBtn = document.getElementById('salvarEndereco');
if (salvarEnderecoBtn) {
  salvarEnderecoBtn.addEventListener('click', () => {
    const novoEnderecoInput = document.getElementById('enderecoInput');
    if (!novoEnderecoInput) return;

    const novoEndereco = novoEnderecoInput.value.trim();
    if (!novoEndereco) {
      alert('Por favor, selecione ou digite um endereço.');
      return;
    }

    fetch('../controle/atualizarEndereco.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'endereco=' + encodeURIComponent(novoEndereco)
    })
    .then(response => response.json())
    .then(data => {
      if (data.ok) {
        document.getElementById('enderecoAtual').innerHTML = '<strong>' + data.endereco + '</strong>';
        document.getElementById('campoEndereco').style.display = 'none';
        alert('Endereço atualizado com sucesso!');
      } else {
        alert(data.erro || 'Erro ao atualizar endereço.');
      }
    })
    .catch(() => alert('Erro ao se comunicar com o servidor.'));
  });
}

function editarEndereco() {
  const input = document.getElementById('endereco');
  const salvar = document.getElementById('salvar-endereco');

  if (input && salvar) {
    input.removeAttribute('readonly');
    input.focus();
    salvar.style.display = 'inline-block';
  }
}

const formEndereco = document.getElementById('endereco-form');
if (formEndereco) {
  formEndereco.addEventListener('submit', function(e) {
    e.preventDefault();
    const endereco = document.getElementById('endereco').value.trim();

    if (endereco === '') {
      alert('Por favor, preencha o endereço.');
      return;
    }

    fetch('./controle/atualizarEndereco.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'endereco=' + encodeURIComponent(endereco)
    })
    .then(response => response.json())
    .then(data => {
      if (data.ok) {
        alert('Endereço atualizado com sucesso!');
        document.getElementById('endereco').setAttribute('readonly', true);
        document.getElementById('salvar-endereco').style.display = 'none';
      } else {
        alert(data.erro || 'Erro ao atualizar endereço.');
      }
    })
    .catch(() => alert('Erro ao se comunicar com o servidor.'));
  });
}
