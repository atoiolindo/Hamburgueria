<?php 

require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $linha['nome'];
$nome_real = $linha['nome_real'];
$ingredientes = $linha['ingredientes'];
$valor = $linha['valor'];
$tipo = $linha['tipo'];
$foto = $linha['foto'];

$nome_arquivo = $_FILES['foto']['name'];
$caminho_temporario = $_FILES['foto']['tmp_name'];
$extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
$novo_nome = uniqid() . "." . $extensao;
$caminho_destino = "fotos/" . $novo_nome;
move_uploaded_file($caminho_temporario, $caminho_destino);

$descricao = $linha['descricao'];

if ($id == 0) {
    salvarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao);
} else {
    editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto);
}

header("Location: home.php");
?>