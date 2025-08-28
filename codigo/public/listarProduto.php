<?php
    require_once "../controle/verificaLogado.php";
    require_once "../controle/funcoes.php";
?>

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
    require_once "../controle/verificaLogado.php";
    require_once "../controle/funcoes.php";

    $lista_produtos = listarProduto($conexao);
    
    //verificar se encontrou produtos antes de imprimir.
    if (count($lista_produtos) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Foto</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Endereço</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_produtos as $produto) {
            $idproduto = $produto['idproduto'];
            $nome = $cliente['nome'];
            $cpf = $cliente['cpf'];
            $endereco = $cliente['endereco'];
            $foto = $cliente['foto'];

            echo "<tr>";
            echo "<td>$idcliente</td>";
            echo "<td><img src='fotos/$foto'></td>";
            echo "<td>$nome</td>";
            echo "<td>$cpf</td>";
            echo "<td>$endereco</td>";
            echo "<td><a href='formCliente.php?id=$idcliente'>Editar</a></td>";
            echo "<td><a href='deletarCliente.php?id=$idcliente'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>