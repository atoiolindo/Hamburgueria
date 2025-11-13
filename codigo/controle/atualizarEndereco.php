<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";
session_start();

if (!isset($_SESSION['idcliente'])) {
    http_response_code(403);
    echo json_encode(array(array("Não autenticado")));
    exit;
}

$idcliente = $_SESSION['idcliente'];

// Sem o ??, usando isset
$novoEndereco = '';
if (isset($_POST['endereco'])) {
    $novoEndereco = trim($_POST['endereco']);
}

if ($novoEndereco === '') {
    http_response_code(400);
    echo json_encode(array(array("Endereço vazio")));
    exit;
}

if (atualizarEndereco($conexao, $idcliente, $novoEndereco)) {
    $_SESSION['endereco'] = $novoEndereco;
    echo json_encode(array(array(true, $novoEndereco)));
} else {
    http_response_code(500);
    echo json_encode(array(array("Erro ao atualizar endereço")));
}
