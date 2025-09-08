<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ingredientes</title>
</head>

<body>
    <h1>Lista de ingredientes</h1>

    <?php
    //require_once "../controle/verificaLogado.php";
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_armazenamento = listarArmazenamento($conexao);
    

    if (count($lista_armazenamento) == 0) {
        echo "Não existem ingrendientes cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Quantidade</td>
                <td>Nome</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_armazenamento as $armazenamento) {
            $idingrediente = $armazenamento['idingrediente'];
            $quantidade = $armazenamento['quantidade'];
            $nome = $armazenamento['nome'];

            echo "<tr>";
            echo "<td>$idingrediente</td>";
            echo "<td>$quantidade</td>";
            echo "<td>$nome</td>";
            echo "<td><a href='formArmazenamento.php?id=$idingrediente'>Editar</a></td>";
            echo "<td><a href='../controle/deletarArmazenamento.php?id=$idingrediente'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>