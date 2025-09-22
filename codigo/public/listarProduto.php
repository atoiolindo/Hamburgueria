<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <h1>Lista de produtos</h1>

    <?php
    //require_once "../controle/verificaLogado.php";
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_produtos = listarProduto($conexao);
    
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
                <td colspan="2">Ação</td>
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
            echo "<td><a href='formProduto.php?id=$idproduto'>Editar</a></td>";
            echo "<td><a href='../controle/deletarProduto.php?id=$idproduto'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>