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


function editarCliente($conexao, $nome, $cpf, $endereco, $idcliente) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, endereco=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $cpf, $endereco, $idcliente);
    
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

function salvarFuncionario($conexao, $nome, $cpf, $cargo) {
    $sql = "INSERT INTO funcionario (nome, cpf, cargo) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $cpf, $cargo);
    
    mysqli_stmt_execute($comando);
    
    $idfuncionario = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idfuncionario;
};

function editarFuncionario($conexao, $nome, $cpf, $cargo, $idfuncionario) {
    $sql = "UPDATE funcionario SET nome=?, cpf=?, cargo=? WHERE idfuncionario=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $cpf, $cargo, $idfuncionario);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; 
};

function deletarFuncionario($conexao, $idfuncionario) {
    $sql = "DELETE FROM funcionario WHERE idfuncionario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idfuncionario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};

function salvarUsuario($conexao, $nome, $email, $senha) {
    $sql = "INSERT INTO tb_usuario (nome, email, senha) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($comando, 'sss', $nome, $email, $senha_hash);

    $funcionou = mysqli_stmt_execute($comando);

   mysqli_stmt_close($comando);
    return $funcionou;
};
function listarVenda($conexao) {
    // seleciona as vendas
    $sql = "SELECT * FROM venda";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    
    $vendas = [];
    while ($venda = mysqli_fetch_assoc($resultado)) {
        // busca o nome do cliente
        $clienteS = "SELECT nome FROM cliente WHERE idcliente = {$venda['idcliente']}";
        $cliente_resultado = mysqli_query($conexao, $clienteS);
        $cliente = mysqli_fetch_assoc($cliente_resultado);
        
        // busca o nome do produto
        $funcionarioS = "SELECT nome FROM funcionario WHERE idfuncionario = {$venda['idfuncionario']}";
        $funcionario_resultado = mysqli_query($conexao, $funcionarioS);
        $funcionario = mysqli_fetch_assoc($funcionario_resultado);

        // adiciona dados p venda
        $venda['nome_cliente'] = $cliente['nome'];
        $venda['nome_funcionario'] = $funcionario['nome'];

        // adiciona venda p lista
        $vendas[] = $venda;
    }
    mysqli_stmt_close($comando);
    return $vendas;
}


function salvarVenda($conexao, $valor_final, $observacao, $data, $idcliente, $idfuncionario) {
    $sql = "INSERT INTO tb_venda (valor_final, observacao, data, idcliente, idfuncionario) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'dssii', $valor_final, $observacao, $data, $idcliente, $idfuncionario);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
};


function deletarVendas($conexao, $idvendas) {
    $sql = "DELETE FROM vendas WHERE idvendas = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idvendas);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};
?>