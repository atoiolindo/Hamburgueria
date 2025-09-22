<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>

<body>
    <h1>Lista de usuarios</h1>

    <?php
    //require_once "../controle/verificaLogado.php";
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_usuarios = listarUsuario($conexao);
    

    if (count($lista_usuarios) == 0) {
        echo "Não existem usuarios cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Senha</td>
                <td>Tipo</td>
            </tr>

        <?php
        foreach ($lista_usuarios as $usuario) {
            $idusuario = $usuario['idusuario'];
            $nome = $usuario['nome'];
            $email = $usuario['email'];
            $senha = $usuario['senha'];
            $tipo = $usuario['tipo'];

            echo "<tr>";
            echo "<td>$idusuario</td>";
            echo "<td>$nome</td>";
            echo "<td>$email</td>";
            echo "<td>$senha</td>";
            echo "<td>$tipo</td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>