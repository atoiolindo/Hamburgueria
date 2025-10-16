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
    <title>Lista de Clientes</title>
</head>

<body>
    <h1>Lista de clientes</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_clientes = listarCliente($conexao);
    

    if (count($lista_clientes) == 0) {
        echo "Não existem clientes cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Endereço</td>

                <?php 
                if ($tipo_usuario == 'a') {
                echo "<td colspan='2'>Ação</td>";
                }?>

            </tr>

        <?php
        foreach ($lista_clientes as $cliente) {
            $idcliente = $cliente['idcliente'];
            $nome = $cliente['nome'];
            $telefone = $cliente['telefone'];
            $endereco = $cliente['endereco'];

            echo "<tr>";
            echo "<td>$idcliente</td>";
            echo "<td>$nome</td>";
            echo "<td>$telefone</td>";
            echo "<td>$endereco</td>";
            
            if ($tipo_usuario == 'a') {
            echo "<td><a href='formCliente.php?id=$idcliente'>Editar</a></td>";
            echo "<td><a href='../controle/deletarCliente.php?id=$idcliente'>Excluir</a></td>";
            }
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>