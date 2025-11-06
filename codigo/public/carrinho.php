<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>🍔 Hamburgueria Delícia</title>
  <link rel="stylesheet" href="./css/carrinho.css">
</head>
<body>
  <h1>🍔 Hamburgueria Delícia</h1>

  <div class="menu">
    <div class="item">
      <h3>Hambúrguer Clássico</h3>
      <p>R$ 18,00</p>
      <button onclick="addToCart('Hambúrguer Clássico', 18)">Adicionar</button>
    </div>
    <div class="item">
      <h3>Cheddar Bacon</h3>
      <p>R$ 22,00</p>
      <button onclick="addToCart('Cheddar Bacon', 22)">Adicionar</button>
    </div>
    <div class="item">
      <h3>Veggie Burger</h3>
      <p>R$ 20,00</p>
      <button onclick="addToCart('Veggie Burger', 20)">Adicionar</button>
    </div>
  </div>

  <button id="open-cart" style="display:none;">🛒 Ver Carrinho</button>

  <div id="cart-sidebar" class="cart-sidebar">
    <div class="cart-header">
      <h2>Seu pedido</h2>
      <button id="close-cart">&times;</button>
    </div>
    <div id="cart-items" class="cart-items"></div>
    <div class="cart-footer">
      <p id="cart-total">Total: R$ 0,00</p>
      <button class="checkout-btn">Finalizar Pedido</button>
    </div>
  </div>

  <div id="overlay" class="overlay"></div>

  <script src="funcoes.js"></script>
</body>
</html>
