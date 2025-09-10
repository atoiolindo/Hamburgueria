<?php 
require_once "conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$nome_real = $_POST['nome_real'];
$ingredientes = $_POST['ingredientes'];

$idingrediente = $_GET['idingrediente']; // array de IDs de produtos
$quantidade = $_GET['quantidade']; // array associativo [idingrediente => qtd]

foreach ($idingrediente as $ingrediente) {
    $ingredientes[] = [$ingrendite, $quantidade[$ingrediente]];
}


$valor = $_POST['valor'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];

$nome_arquivo = $_FILES['foto']['name'];

$caminho_temporario = $_FILES['foto']['tmp_name'];

// pega a extensão do arquivo
$extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

//gera um novo nome para o arquivo
$novo_nome = uniqid() . "." . $extensao;

//criando um novo caminho para o arquivo (usando o endereço da página)
//lembre-se de criar a pasta "fotos/" dentro da pasta "codigo".
//deve ajustar as permissões da pasta "fotos".
$caminho_destino = "fotos/" . $novo_nome;

//movendo o arquivo para o servidor
move_uploaded_file($caminho_temporario, $caminho_destino);

if ($id == 0) {
    salvarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $novo_nome, $descricao);
    foreach ($ingredientes as $i) {
    salvarIngrediente($conexao, $idvenda, $i[0], $i[1], $quantidade);
}
} else {
    editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $descricao, $id);
}

header("Location: ../public/index.php");