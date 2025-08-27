
<?php

$pesquisa = $_GET['pesquisa'];

$produtos = [
    'Hambúrguer Clássico',
    'Cheddar Bacon',
    'Vegano',
    'Frango Crocante',
    'Batata Frita',
    'Refrigerante'
];

$resultados = [];
if ($pesquisa != '') {
    foreach ($produtos as $produto) {
        if (stripos($produto, $pesquisa) !== false) {
            $resultados[] = $produto;
        }
    }
}
?>
<!DOCnk rel="stylesheet" href="./css/index.css">
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
            echo '<li>' . $item . '</li>';
        }
        echo '</ul>';
    }
    ?>
    <a href="index.php">Voltar</a>
</body>
</html>
</head>
