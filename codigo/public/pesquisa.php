
<?php
// require_once "../conexao.php";
// require_once "../funcoes.php";

// function pesquisar($conexao, $nome)
    
//     $sql = "SELECT nome FROM produto WHERE nome LIKE ?";
//     $comando = mysqli_prepare($conexao, $sql);

//     $like_nome = "%" . $nome . "%";
//     mysqli_stmt_bind_param($comando, 's', $like_nome);

//     mysqli_stmt_execute($comando);
//     $resultado = mysqli_stmt_get_result($comando);

//     $produtos = [];
//     while ($produto = mysqli_fetch_assoc($resultado)) {
//         $produtos[] = $produto;
//     }

//     mysqli_stmt_close($comando);
//     return $produtos;
// };

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
<!-- <!DOCnk rel="stylesheet" href="./css/index.css"> -->
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
