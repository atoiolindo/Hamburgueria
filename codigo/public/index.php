<?php
session_start();
$usuario_logado = isset($_SESSION['logado']) && $_SESSION['logado'] === 'sim';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 
    <script>
        function toggleMenu() {
            const menu = document.getElementById('sideMenu');
            menu.classList.toggle('open');
        }
    </script>

</head>
<body>
<div class="cabecalho">

    <button class="menu-btn" onclick="toggleMenu()" title="Menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    <nav id="sideMenu" class="side-menu">
        <button class="close-btn" onclick="toggleMenu()" title="Fechar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <ul>
            <br><br><br>
            <li><a href="home.php">Entrar</a></li>
            <li><a href="index.php">Início</a></li>
            <li><a href="cardapio.php">Cardápio</a></li>
            <li><a href="formProduto.php">Cadastrar novo produto</a></li>
            <li><a href="listarProduto.php">Lista de produtos cadastrados</a></li>
            <li><a href="formCliente.php">Cadastrar novo cliente</a></li>
            <li><a href="listarCliente.php">Lista de clientes cadastrados</a></li>
            <li><a href="formVenda.php">Cadastrar nova venda</a></li>
            <li><a href="listarVenda.php">Lista de vendas cadastrados</a></li>
            <li><a href="formArmazenamento.php">Cadastrar novo ingrediente</a></li>
            <li><a href="listarArmazenamento.php">Lista de ingredientes cadastrados</a></li>
            <li><a href="historia.php">História/Política de Privacidade</a></li>
            <li><a href="deslogar.php">Sair</a></li>
        </ul>
    </nav>
<form class="barra-pesquisa" action="pesquisa.php" method="get">
    <button type="submit" title="Pesquisar">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <input type="text" name="pesquisa" placeholder="Pesquisar">

</form>
<br>
<div class="icone-pesquisa">
    <a href="home.php" title="Login"><i class="fa-solid fa-user"></i></a>
    <a href="carrinho.php" title="Carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
    
</div>

<?php if ($usuario_logado): ?>
    <a href="perfil.php" title="Perfil"><i class="fa-solid fa-user"></i></a>
<?php else: ?>
    <a href="home.php" title="Login"><i class="fa-solid fa-user"></i></a>
<?php endif; ?>


<br>
<div class="divisoria"></div><br><br>

<div class="banner-vermelho">
  <div class="conteudo-banner">
    
    <div class="texto-banner">
      <h1 style="font-family: 'Bevan', serif;">Hamburgueria Pão & Magia: Sua larica, nossa alegria!</h1><br><br><br>
      <h4>Hambúrgueres artesanais com ingredientes caseiros deliciosos.</h4><br><br>
      <a href="cardapio.php" class="btn-cardapio">Peça agora!</a><br><br><br>
    </div>

    <div class="imagem-banner-fundo">
      <img id="molho-banner" src="assets/molho.png" alt="Molho decorativo">
      <img id="hamburguer-banner" src="assets/hamburguer.png" alt="Hambúrguer delicioso">
    </div>

  </div>
</div>
</div>
<br><br><br><br>






<h2 id= "titulo-cardapio"style="font-family: 'Bevan', serif; color: #4B1203;">Cardápio Pão & Magia</h2>

<div class="cardapio-bolinhas">
    <div class="linha-bolinhas">
        <a href="cardapio.php" class="bolinha">Burguer Bovino</a>
        <a href="cardapio.php" class="bolinha">Burguer de Frango</a>
        <a href="cardapio.php" class="bolinha">Burguer Suíno</a>
    </div>
    <div class="linha-bolinhas centralizada">
        <a href="cardapio.php" class="bolinha">Batata Frita</a>
        <a href="cardapio.php" class="bolinha">Refrigerantes</a>
    </div>
</div>



<h2 style="font-family: 'Bevan', serif; color: #4B1203;">Nossos itens mais pedidos </h2><br><br>


<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;">Feitiço Clássico</h5>
    <p class="card-text">R$33,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>


<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;">Encantamento Dourado</h5>
    <p class="card-text">R$40,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>


<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;">Trio Arcano</h5>
    <p class="card-text">R$35,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>


<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;">Gorgonzola Místico</h5>
    <p class="card-text">R$42,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>

<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;">Batata Frita Média Simples</h5>
    <p class="card-text">R$13,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>

<div class="card" style="width: 18rem;">
    <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="180" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
    <div class="card-body">

    <h5 style="font-family: 'Bevan', serif; color: #4B1203;"> Coca-Cola Lata</h5>
    <p class="card-text">R$5,00</p>
    <a href="" class="btn-cardapio">Ver Produto</a>

    </div>
</div>

<br><br>

<a href="cardapio.php" class="btn-botao">Ver todos os produtos</a> <br><br><br><br>


<h2 style="font-family: 'Bevan', serif; color: #4B1203;">Sobre nós</h2><br>
<p class="sobre-nos"> Somos apaixonados por hambúrgueres e acreditamos que cada mordida deve ser uma experiência inesquecível. Surgimos 
da vontade de oferecer mais do que refeições rápidas — queremos proporcionar momentos, sabores marcantes e aquele gostinho de quero mais.</p>

<p class="sobre-nos">Na nossa hamburgueria, unimos ingredientes frescos, carnes selecionadas e receitas autorais, sempre preparados com 
muito carinho e atenção aos detalhes. Nosso ambiente foi pensado para que você se sinta em casa, seja para um almoço descontraído, 
um encontro entre amigos ou um jantar especial.</p>

<p class="sobre-nos">Aqui, valorizamos a simplicidade e a qualidade. Do pão artesanal às combinações 
criativas de molhos e acompanhamentos, cada item do nosso cardápio é cuidadosamente elaborado para surpreender.</p>
<a href="sobre.html" class="btn-botao">Saiba mais</a> <br><br><br><br>



</body>
 <footer>
 Horários de Funcionamento: <br>
    Segunda a Sábado: 17h - 22h <br>
    Domingo: Fechado<br><br>
 
 Informações<br>
    Sobre Nós<br>
    Política de Privacidade<br>
    Endereço<br>
    <a href="https://access.workspace.google.com/ServiceNotAllowed?application=960906454010&source=scrip&continue=https://www.google.com/maps/place/Rua%2BLuiz%2BFagund
    es,%2B51%2B-%2BPicadas%2Bdo%2BSul,%2BS%25C3%25A3o%2BJos%25C3%25A9%2B-%2BSC,%2B88104-300/data%3D!4m2!3m1!1s0x9527360529045821:0x780b6dd572a37?sa%3DX%26ved%3D1t:242%
    26ictx%3D111&marker=c79b2205-0fca-4ee3-890a-f2dc68f5874a&pli=1">Rua Luiz Fagundes, 51 - Praia Comprida, São José - SC, 88103-500</a> <br>

 </footer>
</html>