<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";
session_start();

if (!isset($_SESSION['idcliente'])) {
    http_response_code(403);
    echo json_encode(["erro" => "Não autenticado"]);
    exit;
}

$idcliente = $_SESSION['idcliente'];
$novoEndereco = trim($_POST['endereco'] ?? '');

if ($novoEndereco === '') {
    http_response_code(400);
    echo json_encode(["erro" => "Endereço vazio"]);
    exit;
}

if (atualizarEndereco($conexao, $idcliente, $novoEndereco)) {
    echo json_encode(["ok" => true, "endereco" => $novoEndereco]);
} else {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar endereço"]);
}
