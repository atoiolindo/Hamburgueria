<?php


function deletarProduto($conexao, $idproduto) {    
    $sql = "DELETE FROM produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};
//  testar

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

// testar

function salvarProduto($conexao, $nome, $quantidade, $ingredientes, $valor, $tipo) {
    $sql = "INSERT INTO produto (nome, quantidade, ingredientes, valor, tipo) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssds', $nome, $quantidade, $ingredientes, $valor, $tipo);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

// testar

function editarProduto($conexao, $nome, $quantidade, $ingredientes, $valor, $tipo) {  
    $sql = "UPDATE produto SET nome=?, quantidade=?, ingredientes=?, valor=?, tipo=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sssdsi', $nome, $quantidade, $ingredientes, $valor, $tipo, $idproduto);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};

// testar

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


function salvarCliente($conexao, $nome, $email, $endereco) {
    $sql = "INSERT INTO cliente (nome, email, endereco) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $email, $endereco);
    
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


function deletarVenda($conexao, $idvenda) {
    $sql = "DELETE FROM venda WHERE idvendas = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idvenda);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};


function editarVenda($conexao, $valor_final, $observacao, $data, $idvenda) {
    $sql = "UPDATE venda SET valor_final=?, observacao=?, data=? WHERE idvenda=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'dssi', $valor_final, $observacao, $data, $idvenda);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; 
};

function pesquisarProduto($conexao, $idproduto) {
    $sql = "SELECT * FROM produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
};

function pesquisarArmazenamento($conexao, $idingredientes) {
    $sql = "SELECT * FROM armazenamento WHERE idingredientes = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingredientes);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
};


function salvarItemVenda($conexao, $id_venda, $id_produto, $quantidade, $valor, $observacao) {
    $sql = "INSERT INTO item_venda (idvenda, idproduto, quantidade, valor, observacao) VALUES (?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'iiids', $id_venda, $id_produto, $quantidade, $valor, $observacao);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}

function listarItemVenda($conexao, $idvenda) {
    $sql = "SELECT * FROM item_venda WHERE idvenda = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idvenda);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_itens = [];
    while ($item = mysqli_fetch_assoc($resultado)) {

        
        $id_produto = $item['idproduto'];
        $produto = pesquisarProduto($conexao, $id_produto);
        $nome_produto = $produto['nome'];

        $item['nome_produto'] = $nome_produto;
        $lista_itens[] = $item;
    }

    mysqli_stmt_close($comando);
    return $lista_itens;
};

function salvarIngrediente($conexao, $idproduto, $idingredientes, $quantidade) {
    $sql = "INSERT INTO tb_item_venda (idvenda, idproduto, quantidade) VALUES (?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'iii', $idproduto, $idingredientes, $quantidade);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}

function listarIngrediente($conexao, $idvenda) {
    $sql = "SELECT * FROM Ingrediente WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idvenda);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_itens = [];
    while ($item = mysqli_fetch_assoc($resultado)) {

        
        $id_ingredintes = $item['idingredientes'];
        $ingredientes = pesquisarArmazenamento($conexao, $id_ingredintes);
        $nome_ingredientes = $ingredientes['nome'];

        $item['nome_produto'] = $nome_ingredientes;
        $lista_itens[] = $item;
    }

    mysqli_stmt_close($comando);
    return $lista_itens;
};

function listarArmazenamento($conexao) {
    $sql = "SELECT * FROM armazenamento";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando); 
    $resultado = mysqli_stmt_get_result($comando);

    $lista_armazenamento = [];
    while ($armazenamento = mysqli_fetch_assoc($resultado)){
        $lista_armazenamento[] = $armazenamento;
    }

    mysqli_stmt_close($comando);
    return $lista_armazenamento;
};
// testar

function deletarArmazenamento($conexao, $idingredientes) {    
    $sql = "DELETE FROM armazenamento WHERE idingredientes = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingredientes);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
//testar
};

function salvarArmazenamento($conexao, $nome, $quantidade) {
    $sql = "INSERT INTO produto (nome, quantidade) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'si', $nome, $quantidade);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

// testar

function editarArmazenamento($conexao, $nome, $quantidade) {
    $sql = "UPDATE armazenamento SET nome=?, quantidade=? WHERE idingredientes=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sii', $nome, $quantidade, $idingredientes);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};
//testar

?>