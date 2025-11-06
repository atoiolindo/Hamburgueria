<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/pagamento.css">
  <title>Formas de Pagamento</title>
</head>
<body>

  <div class="container">
    <h2>Métodos de pagamento</h2>
    <p class="descricao">Forma como pode pagar seus pedidos:</p>

    <div class="metodo ativo">
      <div class="icone">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Pix_Logo.png" alt="Pix">
      </div>
      <div class="info">
        <h3>Pix</h3>
        <p>Pagamento instantâneo pelo app do seu banco</p>
      </div>
      <div class="status">
        <span class="ativo">Ativado</span>
      </div>
    </div>

    <div class="metodo desativado">
      <div class="icone">
        <img src="https://cdn-icons-png.flaticon.com/512/633/633611.png" alt="Cartão">
      </div>
      <div class="info">
        <h3>Cartão de crédito</h3>
        <p>Indisponível no momento</p>
      </div>
      <div class="status">
        <span class="desativado">Desativado</span>
      </div>

      <div id="voltar">
        <a href="index.php" class="voltar">Voltar</a>
      </div>

    </div>
  </div>

</body>
</html>
