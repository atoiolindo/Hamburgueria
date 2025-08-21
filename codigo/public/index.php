<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">

</head>
<body>
    <h2>Bem-vindo à Hamburgueria</h2>
    <form class="search-bar" action="pesquisar.php" method="get">
        <input type="text" name="q" placeholder="Pesquisar produto, cliente...">
        <button type="submit">Pesquisar</button>
        <div class="search-icons">
            <a href="home.php" title="Login"><i class="fa-solid fa-user"></i></a>
            <a href="carrinho.php" title="Carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </form>
    <div class="container">
        <div class="menu">
            <ul>
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
        </div>
        <div class="login" id="login">
            <h3>Login</h3>
            <form action="home.php" method="post">
                <input type="text" name="usuario" placeholder="Usuário" required><br>
                <input type="password" name="senha" placeholder="Senha" required><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>