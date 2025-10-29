<?php
require_once "../controle/funcoes.php";
// verificarPermissao(['a', 'b']);


    if (isset($_GET['id'])) {
        
        require_once "../controle/conexao.php";
        require_once "../controle/funcoes.php";

        $id = $_GET['id'];
        
        $cliente = pesquisarCliente($conexao, $id);
        $nome = $cliente['nome'];
        $telefone = $cliente['telefone'];
        $endereco = $cliente['endereco'];
        $email = $cliente['email'];

        $botao = "Atualizar";
        $favicon = './assets/editar.png';
    }
    else {
        // echo "novo";
        $id = 0;
        $nome = "";
        $telefone = "";
        $endereco = "";
        $email = "";

        $botao = "Cadastrar";
        $favicon = './assets/cadastrar.png';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">
    <script src="../controle/jquery-3.7.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../controle/funcoes.js"></script>
    <script src="../controle/mask.js"></script>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form action="../controle/salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

        Nome Completo: *nao é possivel alterar posteriormente<br> 
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        Telefone: <br>
        <input type="text" name="telefone" id="telefone" value="<?php echo $telefone; ?>"> <br><br>
        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>