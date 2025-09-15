<?php 
require_once "conexao.php";
require_once "funcoes.php";



$id = $_GET['id'];
$nome = $_POST['nome'];
$nome_real = $_POST['nome_real'];
$ingredientes = $_POST['ingredientes'];

// Como os checkboxes podem não ser marcados, usamos isset() para evitar erro
// Se não tiver ingredientes marcados, ficam arrays vazios
$idingrediente = isset($_POST['idingrediente']) ? $_POST['idingrediente'] : [];
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : [];

// Criamos um array $ingredientes2 com [idingrediente, quantidade]
// Se não tiver ingredientes marcados, esse foreach nem roda
$ingredientes2 = [];

if (!empty($idingrediente)) {
    foreach ($idingrediente as $ingrediente) {
        $ingredientes2[] = [$ingrediente, $quantidade[$ingrediente] ?? 0];
    }
}
foreach ($idingrediente as $ingrediente) {
    $ingredientes2[] = [$ingrediente, $quantidade[$ingrediente]];
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

    $idproduto = mysqli_insert_id($conexao);
    
     // Se tiver ingredientes, salva cada um deles
    if (!empty($ingredientes2)) {
        foreach ($ingredientes2 as $i) {
            salvarIngrediente($conexao, $idproduto, $i[0], $i[1]);
        }
    }
} else {
    // Atualiza produto
    editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $descricao, $id);

    // Remove ingredientes antigos
    $sql_del = "DELETE FROM ingrediente WHERE idproduto = ?";
    $stmt = $conexao->prepare($sql_del);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Insere ingredientes novos
    if (!empty($ingredientes2)) {
        foreach ($ingredientes2 as $i) {
            salvarIngrediente($conexao, $id, $i[0], $i[1]);
        }
    }
}

header("Location: ../public/index.php");