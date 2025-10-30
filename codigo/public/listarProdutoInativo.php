<?php
require_once "../controle/funcoes.php";
verificarPermissao(['a']);

if (isset($_SESSION['nome'])) {
    $nome_usuario = $_SESSION['nome'];
    $tipo_usuario = $_SESSION['tipo'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Inativos</title>
    <link rel="stylesheet" href="./css/listar.css">
    
    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="list-container">
    <h2>Lista de produtos Inativos</h2>

    <?php
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_produtos = listarProdutoInativo($conexao);
    
    if (count($lista_produtos) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Foto</td>
                <td>Nome</td>
                <td>Nome real</td>
                <td>Ingredientes</td>
                <td>Valor</td>
                <td>Tipo</td>
                <td>Descrição</td>
                <td colspan='2'>Ação</td>
            </tr>

        <?php
        foreach ($lista_produtos as $produto) {
            $idproduto = $produto['idproduto'];
            $nome = $produto['nome'];
            $nome_real = $produto['nome_real'];
            $ingredientes = $produto['ingredientes'];
            $valor = $produto['valor'];
            $tipo = $produto['tipo'];
            $foto = $produto['foto'];
            $descricao = $produto['descricao'];

            echo "<tr>";
            echo "<td>$idproduto</td>";
            echo "<td><img src='../controle/fotos/$foto'></td>";
            echo "<td>$nome</td>";
            echo "<td>$nome_real</td>";
            echo "<td>$ingredientes</td>";
            echo "<td>$valor</td>";
            echo "<td>$tipo</td>";
            echo "<td>$descricao</td>";

            if ($tipo_usuario == 'a') {
            echo "<td><a href='formProduto.php?id=$idproduto'><img src='./assets/editar.png' alt='editar'></a></td>";
            echo "<td><a href='../controle/adicionarProduto.php?id=$idproduto'>Adicionar</a></td>";
            }
            echo "</tr>";
        }
    }
        ?>
        </table>
    </div>
</body>

</html>