<?php

function salvarCliente($conexao, $nome, $telefone, $endereco) {
    $sql = "INSERT INTO cliente (nome, telefone, endereco) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $telefone, $endereco);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
};
// function listarCliente($conexao)
// function editarCliente($conexao, $nome, $telefone, $endereco, $id)
// function deletarCliente($conexao, $idcliente)

// function salvarProduto($conexao,$nome, $ingredientes,$preco)
// function listarProduto($conexao)
// function editarProduto($conexao,$nome,$ingredientes, $preco, $id)
// function deletarProduto($conexao, $idproduto)

// function salvarArmazenamento($conexao,$tipo, $quantidade, $nome,$idfuncionario)
// function listarArmazenamento($conexao)
// function editarArmazenamento($conexao,$tipo, $quantidade, $nome,$idfuncionario)
// function deletarArmazenamento($conexao, $idarmazenamento)

// function salvarVenda($conexao,$valor_final, $observacao, $data,$idclient,$idfuncionario)
// function listarVenda($conexao)
// function editarVenda($conexao,$valor_final, $observacao, $data,$idclient,$idfuncionario)
// function deletarVenda($conexao, $idvenda)

// function salvarVendaProduto($conexao,$idvenda,$idproduto, $quantidade, $valor)
// function listarVendaProduto($conexao)
// function editarVendaProduto($conexao,$idvenda,$idproduto, $quantidade, $valor)
// function deletarVendaProduto($conexao, $idvenda, $idproduto)

// function salvarusuario($conexao,$nome,$email,$senha)
// function editarusuario($conexao,$nome,$email,$senha)  
// function deletarusuario($conexao,$idusuario)

?>