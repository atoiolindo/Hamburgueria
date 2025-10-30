<?php
require_once "../controle/funcoes.php";
verificarPermissao(['a', 'b']);

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
    <title>Lista de Ingredientes</title>
    <link rel="stylesheet" href="./css/listar.css">
</head>

<body>
    <div class="list-container">
    <h2>Lista de ingredientes</h2>

    <?php
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
                
                <?php 
                if ($tipo_usuario == 'a') {
                echo "<td colspan='2'>Ação</td>";
                } ?>
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

            if ($tipo_usuario == 'a') {
            echo "<td><a href='formArmazenamento.php?id=$idingrediente'>Editar</a></td>";
            echo "<td><a href='../controle/deletarArmazenamento.php?id=$idingrediente'>Excluir</a></td>";
            }
            echo "</tr>";
        }
    }
        ?>
        </table>
    </div>
</body>

</html>