<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { display: flex; gap: 40px; }
        .menu, .login { background: #f9f9f9; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        .search-bar { margin-bottom: 24px; }
        .search-bar input[type="text"] { padding: 8px; width: 220px; }
        .search-bar button { padding: 8px 16px; }
        .login input { margin-bottom: 8px; width: 180px; padding: 6px; }
        .login button { padding: 8px 16px; }
    </style>
</head>
<body>
    <h2>Bem-vindo à Hamburgueria</h2>
    <div class="container">
        <div class="menu">
            <form class="search-bar" action="pesquisar.php" method="get">
                <input type="text" name="q" placeholder="Pesquisar produto, cliente...">
                <button type="submit">Pesquisar</button>
            </form>
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
        <div class="login">
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