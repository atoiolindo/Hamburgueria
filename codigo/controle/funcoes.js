function calcular() {
    let total = 0;

    // pega todos os checkboxes de produtos
    document.querySelectorAll("input[type=checkbox][id^='marcado_']").forEach(cb => {
        if (cb.checked) {
            let id = cb.value;
            let preco = parseFloat(document.getElementById('preco_' + id).innerText) || 0;
            let qtd = parseFloat(document.getElementById('quantidade_' + id).value) || 0;
            total += preco * qtd;
        }
    });

    document.getElementById('valor_final').value = total.toFixed(2);
    document.getElementById('mostrar_total').innerText = total.toFixed(2);
}

$(document).ready(function() {
            $("form").on("submit", function(e) {
                let data = $("#data").val().trim();
                if (data === "") {
                    alert("⚠️ Por favor, selecione a data da venda.");
                    e.preventDefault(); // bloqueia envio
                    return false;
                }
            });
        });

function editarTelefone() {
    const input = document.getElementById('telefone');
    input.removeAttribute('readonly');
    input.focus();
}

function editarUsuario() {
    const input = document.getElementById('nome');
    input.removeAttribute('readonly');
    input.focus();
}

const cartSidebar = document.getElementById('cart-sidebar');
const overlay = document.getElementById('overlay');
const cartItemsContainer = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');
const openCartBtn = document.getElementById('open-cart');
const closeCartBtn = document.getElementById('close-cart');

let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.getElementById('salvarEndereco').addEventListener('click', () => {
  const novoEndereco = document.getElementById('enderecoInput').value.trim();

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

