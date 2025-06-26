<?php

function listarCliente($conexao) {
    $sql = "SELECT * FROM cliente";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_clientes = [];
    while ($cliente = mysqli_fetch_assoc($resultado)) {
        $lista_clientes[] = $cliente;
    }

    mysqli_stmt_close($comando);
    return $lista_clientes;
};

function salvarCliente($conexao, $nome, $email, $endereco, $telefone) {
    $sql = "INSERT INTO cliente (nome, email, endereco, telefone) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);  
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $endereco, $telefone);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
};

// function editarCliente($conexao, $nome, $telefone, $endereco, $id)
// function deletarCliente($conexao, $idcliente)

// function salvarProduto($conexao,$nome, $ingredientes,$preco)
function listarProduto($conexao) {
    $sql = "SELECT * FROM produto";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando); 
    $resultado = mysqli_stmt_get_result($comando);

    $lista_produto = [];
    while ($produto = mysqli_fetch_assoc($resultado)){
        $lista_produto[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $lista_produto;
};

function editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto) {
    $sql = "UPDATE produto SET nome=?, nome_real=?, ingredientes=?, valor=?, tipo=?, foto=?, descricao=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sssdsssi', $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};

function deletarProduto($conexao, $idproduto) {    
    $sql = "DELETE FROM produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};

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