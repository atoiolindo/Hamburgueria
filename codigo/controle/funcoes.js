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

// Atualiza o carrinho visualmente
function updateCartUI() {
  cartItemsContainer.innerHTML = '';

  if (cart.length === 0) {
    cartItemsContainer.innerHTML = '<p style="text-align:center; color:#999;">Nenhum produto no carrinho</p>';
    openCartBtn.style.display = 'none';
    localStorage.setItem('cart', JSON.stringify([]));
    cartTotal.textContent = 'Total: R$ 0,00';
    return;
  }

  openCartBtn.style.display = 'flex';
  let total = 0;

  cart.forEach(item => {
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('cart-item');
    itemDiv.innerHTML = `
      <h4>${item.name}</h4>
      <div class="quantity-controls">
        <button onclick="changeQuantity('${item.name}', -1)">-</button>
        <span>${item.quantity}</span>
        <button onclick="changeQuantity('${item.name}', 1)">+</button>
      </div>
      <p>R$ ${(item.price * item.quantity).toFixed(2)}</p>
    `;
    cartItemsContainer.appendChild(itemDiv);
    total += item.price * item.quantity;
  });

  cartTotal.textContent = `Total: R$ ${total.toFixed(2)}`;
  localStorage.setItem('cart', JSON.stringify(cart));
}


function toggleCart() {
    const cart = document.getElementById('sideCart');
    cart.classList.toggle('open');
}
// Função para aumentar quantidade
function aumentarQuantidade(idproduto) {
    window.location.href = '../controle/atualizarCarrinho.php?acao=aumentar&id=' + idproduto;
}
// Função para diminuir quantidade
function diminuirQuantidade(idproduto) {
    window.location.href = '../controle/atualizarCarrinho.php?acao=diminuir&id=' + idproduto;
}
// Função para remover item
function removerItem(idproduto) {
    if (confirm('Remover item do carrinho?')) {
        window.location.href = '../controle/removerCarrinho.php?id=' + idproduto;
    }
}
