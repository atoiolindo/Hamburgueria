
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Vendas</title>
    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <h1>Lista de vendas</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_vendas = listarVenda($conexao);
    
    //verificar se encontrou vendas antes de imprimir.
    if (count($lista_vendas) == 0) {
        echo "Não existem vendas cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Cliente</td>
                <td>Valor</td>
                <td>Observação</td>
                <td>Data</td>
                <td>Status</td>
                <td>Foto</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_vendas as $venda) {
        $idvenda = $venda['idvenda'];
        $valor = $venda['valor_final'];
        $observacao = $venda['observacao'];
        $data = $venda['data'];
        $status = $venda['status'];
        $nome_cliente = $venda['nome_cliente']; // já buscado na função listarVenda
    
        echo "<tr>";
        echo "<td>$idvenda</td>";
        echo "<td>$nome_cliente</td>";
        echo "<td>$valor</td>";
        echo "<td>$observacao</td>";
        echo "<td>$data</td>";
        echo "<td>$status</td>";
    
        // produtos da venda
        echo "<td>";
        $itens = listarItemVenda($conexao, $idvenda); // pega todos os produtos dessa venda
        foreach ($itens as $item) {
            echo "<img src='fotos/{$item['foto']}' width='40'> {$item['nome_produto']} ({$item['quantidade']})<br>";
        }
        echo "</td>";
    
        echo "<td><a href='formVenda.php?id=$idvenda'>Editar</a></td>";
        echo "<td><a href='deletarVenda.php?id=$idvenda'>Excluir</a></td>";
        echo "</tr>";
        }
    }
        ?>
        </table>
</body>



./