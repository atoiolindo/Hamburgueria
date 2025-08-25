<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">

 
    <script>
        function toggleMenu() {
            const menu = document.getElementById('sideMenu');
            menu.classList.toggle('open');
        }
    </script>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()" title="Menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    <nav id="sideMenu" class="side-menu">
        <button class="close-btn" onclick="toggleMenu()" title="Fechar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <ul>
            <br><br><br>
            <li><a href="formProduto.php">Cadastrar novo produto</a></li>
            <li><a href="listarProdutos.php">Lista de produtos cadastrados</a></li>
            <li><a href="formCliente.php">Cadastrar novo cliente</a></li>
            <li><a href="listarCliente.php">Lista de clientes cadastrados</a></li>
            <li><a href="formVenda.php">Cadastrar nova venda</a></li>
            <li><a href="listarVenda.php">Lista de vendas cadastrados</a></li>
            <li><a href="formIngrediente.php">Cadastrar novo ingrediente</a></li>
            <li><a href="listarIngrediente.php">Lista de ingredientes cadastrados</a></li>
            <li><a href="deslogar.php">Sair</a></li>
        </ul>
    </nav>
    <h2>Bem-vindo à Hamburgueria</h2>
    <form class="barra-pesquisa" action="pesquisa.php" method="get">
        <input type="text" name="pesquisa" placeholder="Pesquisar">
        <button type="submit">Pesquisar</button>
        <div class="icone-pesquisa">
            <a href="home.php" title="Login"><i class="fa-solid fa-user"></i></a>
            <a href="carrinho.php" title="Carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </form>

    <h2 style="font-family: 'Bevan', serif;">Hamburgueria pao e magia sua gordura nossa alegria</h2>
</body>
</html>