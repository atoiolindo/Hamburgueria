<?php
require_once "conexao.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$nome_real = $_POST['nome_real'];
$ingredientes = $_POST['ingredientes'];
$valor = $_POST['valor'];
$tipo = $_POST['tipo'];
$foto = $_POST['foto'];
$descricao = $_POST['descricao'];

if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_produto (nome, nome_real, ingredientes, valor, tipo, foto, descricao) VALUES ('$nome', '$tipo', $preco_compra, $preco_venda, $margem_lucro, $quantidade)";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', nome_real = '$nome_real', ingredientes = $ingredientes, valor = $valor, tipo = $tipo, foto = $foto, descricao = $descricao WHERE idproduto = $id";
}
mysqli_query($conexao, $sql);