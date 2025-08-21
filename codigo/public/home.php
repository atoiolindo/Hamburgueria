<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; position: relative; }
        .search-bar {
            position: absolute;
            top: 40px;
            right: 40px;
            background: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #ccc;
            width: 520px;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .search-bar input[type="text"] { padding: 8px; width: 220px; }
        .search-bar button { padding: 8px 16px; }
        .search-icons {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }
        .search-icons a {
            color: #333;
            font-size: 1.6em;
            text-decoration: none;
            transition: color 0.2s;
        }
        .search-icons a:hover {
            color: #f0a913;
        }
        .container { display: flex; gap: 40px; margin-top: 100px; }
        .menu, .login { background: #f9f9f9; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        .login input { margin-bottom: 8px; width: 180px; padding: 6px; }
        .login button { padding: 8px 16px; }
    </style>
</head>
<body>
    <h2>Bem-vindo à Hamburgueria</h2>
    <form class="search-bar" action="pesquisar.php" method="get">
        <input type="text" name="q" placeholder="Pesquisar produto, cliente...">
        <button type="submit">Pesquisar</button>
        <div class="search-icons">
            <a href="#login" title="Login"><i class="fa-solid fa-user"></i></a>
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
            <form action="login.php" method="post">
                <input type="text" name="usuario" placeholder="Usuário" required><br>
                <input type="password" name="senha" placeholder="Senha" required><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>