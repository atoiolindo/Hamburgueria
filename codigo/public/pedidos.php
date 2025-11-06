<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meus Pedidos - Hamburgueria Delícia</title>
  <link rel="stylesheet" href="./css/pedidos.css">

</head>
<body>
  <h1>📦 Meus Pedidos</h1>

  <div id="lista-pedidos"></div>

  <a href="cardapio.php" class="btn-voltar">⬅ Voltar ao Cardápio</a>

  <script>
    const pedidosContainer = document.getElementById('lista-pedidos');
    const pedidos = JSON.parse(localStorage.getItem('pedidos')) || [];

    if (pedidos.length === 0) {
      pedidosContainer.innerHTML = '<p class="no-pedidos">Nenhum pedido encontrado.</p>';
    } else {
      pedidos
        .slice()
        .reverse() // mostra o mais recente primeiro
        .forEach(pedido => {
          const div = document.createElement('div');
          div.classList.add('pedido');
          div.innerHTML = `
            <h3>Pedido #${pedido.id}</h3>
            <p><strong>Data:</strong> ${pedido.data}</p>
            <ul>
              ${pedido.itens.map(item => `
                <li>
                  <span>${item.quantity}x ${item.name}</span>
                  <span>R$ ${(item.price * item.quantity).toFixed(2)}</span>
                </li>
              `).join('')}
            </ul>
            <p class="pedido-total">Total: R$ ${pedido.total.toFixed(2)}</p>
          `;
          pedidosContainer.appendChild(div);
        });
    }
  </script>
</body>
</html>
