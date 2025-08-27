<?php
    if (isset($_GET['id'])) {
        // echo "editar";
        
        require_once "../controle/conexao.php";
        require_once "../controle/funcoes.php";

        $id = $_GET['id'];
        
        $cliente = pesquisarCliente($conexao, $id);
        $nome = $cliente['nome'];
        $email = $cliente['email'];
        $endereco = $cliente['endereco'];
        $telefone = $cliente['telefone'];

        $botao = "Atualizar";
    }
    else {
        // echo "novo";
        $id = 0;
        $nome = "";
        $email = "";
        $endereco = "";
        $telefone = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form action="../controle/salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        Email: <br>
        <input type="text" name="email" value="<?php echo $email; ?>"> <br><br>
        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>
        Telefone: <br>
        <input type="text" name="telefone" id="telefone" value="<?php echo $telefone; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>