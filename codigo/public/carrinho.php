<?php

// require_once "../controle/conexao.php";
// require_once "../controle/funcoes.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Hamburgueria Delícia</title>
  <link rel="stylesheet" href="style.css">
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

  <h2>Carrinho 🛒</h2>
  <ul id="cart-list"></ul>
  <p id="total">Total: R$ 0,00</p>

  <script src="script.js"></script>
</body>
</html>

