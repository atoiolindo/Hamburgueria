
<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

if ($pesquisa != '') {
    $resultados = pesquisar($conexao, $pesquisa);
} else {
    $resultados = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Resultados para: "<?php echo $pesquisa; ?>"</h2>
<?php
    if ($pesquisa == '') {
        echo '<p>Digite algo para pesquisar.</p>';
    } elseif (count($resultados) == 0) {
        echo '<p>Nenhum resultado encontrado.</p>';
    } else {
        echo '<ul>';
    foreach ($resultados as $item) {
        echo '<li>' . $item['nome'] . '</li>';
    }
    }
?>
    
</body>
</html>

<a href="index.php">Voltar</a>

