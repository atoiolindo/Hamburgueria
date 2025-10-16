<?php
require_once "../controle/funcoes.php";
verificarPermissao(['a', 'b']);

    if (isset($_GET['id'])) {
        // echo "editar";
        
        require_once "../controle/conexao.php";
        require_once "../controle/funcoes.php";

        $id = $_GET['id'];
        
        $armazenamento = pesquisarArmazenamento($conexao, $id);
        $quantidade = $armazenamento['quantidade'];
        $nome = $armazenamento['nome'];

        $botao = "Atualizar";
        $favicon = './assets/editar.png';
    }
    else {
        // echo "novo";
        $id = 0;
        $quantidade = "";
        $nome = "";

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
</head>
<body>
    <h1>Cadastro de ingredientes</h1>
    <form action="../controle/salvarArmazenamento.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

        Quantidade: <br>
        <input type="text" name="quantidade" value="<?php echo $quantidade; ?>"> <br><br>
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>