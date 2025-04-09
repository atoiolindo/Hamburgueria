<?php


function deletarProduto($conexao, $idproduto) {    
    $sql = "DELETE FROM produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};


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


function salvarProduto($conexao, $nome, $ingredientes, $preco) {
    $sql = "INSERT INTO produto (nome, ingredientes, preco) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssd', $nome, $ingredientes, $preco);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};


function editarProduto($conexao, $nome, $ingredientes, $preco) {   
    $sql = "UPDATE produto SET nome=?, ingredientes=?, preco=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    mysqli_stmt_bind_param($comando, 'ssdi', $nome, $ingredientes, $preco, $idproduto);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;
};


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


function salvarCliente($conexao, $nome, $telefone, $endereco) {
    $sql = "INSERT INTO cliente (nome, telefone, endereco) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $telefone, $endereco);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
};


function deletarCliente($conexao, $idcliente) {
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};


function listarFuncionario($conexao) {
    $sql = "SELECT * FROM funcionario";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_funcionarios = [];
    while ($funcionario = mysqli_fetch_assoc($resultado)) {
        $lista_funcionarios[] = $funcionario;
    }

    mysqli_stmt_close($comando);
    return $lista_funcionarios;
};

function salvarFuncionario($conexao, $nome, $cpf, $nascimento, $cargo) {
    $sql = "INSERT INTO funcionario (nome, cpf, nascimento, cargo) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssss', $nome, $cpf, $nascimento, $cargo);
    
    mysqli_stmt_execute($comando);
    
    $idfuncionario = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idfuncionario;
};



?>