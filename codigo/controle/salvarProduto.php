<?php 

require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$nome_real = $_POST['nome_real'];
$ingredientes = $_POST['ingredientes'];
$valor = $_POST['valor'];
$tipo = $_POST['tipo'];
$foto = $_FILES['foto'];

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $extensao;
    $caminho_destino = "fotos/" . $novo_nome;

    if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
        $foto = $caminho_destino; // salva o caminho no banco
    }
}

$descricao = $_POST['descricao'];

if ($id == 0) {
    salvarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao);
} else {
    editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto);
}

header("Location: home.php");
?>