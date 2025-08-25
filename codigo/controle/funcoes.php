<?php


function deletarProduto($conexao, $idproduto) {    
    $sql = "DELETE FROM produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};
//  testado e funcionando

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

// testado e funcionando

function salvarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao) {
    $sql = "INSERT INTO produto (nome, nome_real, ingredientes, valor, tipo, foto, descricao) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdsss', $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;  
};

// testado e funcionando

function editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto) {
    $sql = "UPDATE produto SET nome=?, nome_real=?, ingredientes=?, valor=?, tipo=?, foto=?, descricao=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sssdsssi', $nome, $nome_real, $ingredientes, $valor, $tipo, $foto, $descricao, $idproduto);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};

// testado e funcionando

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
// testado e funcionando


function salvarCliente($conexao, $nome, $email, $endereco, $telefone) {
    $sql = "INSERT INTO cliente (nome, email, endereco, telefone) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);  
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $endereco, $telefone);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
};
// testado e funcionando

function deletarCliente($conexao, $idcliente) {
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};


function editarCliente($conexao, $nome, $telefone, $endereco,  $email, $idcliente) {
    $sql = "UPDATE cliente SET nome=?, telefone=?, endereco=?, email=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $telefone, $endereco, $email, $idcliente );
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; 
};


function salvarUsuario($conexao, $nome, $email, $senha) {
    $sql = "INSERT INTO usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $senha_hash, $tipo);

    $funcionou = mysqli_stmt_execute($comando);

   mysqli_stmt_close($comando);
    return $funcionou;
};


function listarUsuario($conexao) {
    $sql = "SELECT * FROM usuario";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_usuarios = [];
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        $lista_usuarios[] = $usuario;
    }

    mysqli_stmt_close($comando);
    return $lista_usuarios;
};

function editarUsuario($conexao, $email, $senha, $nome) {
    $sql = "UPDATE usuario SET email=?, senha=?, nome=? WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssi', $email, $senha, $nome, $idusuario );
    
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


function salvarVenda($conexao, $valor_final, $observacao, $data, $idcliente, $status) {
    $sql = "INSERT INTO venda (valor_final, observacao, data, idcliente, status) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'dssis', $valor_final, $observacao, $data, $idcliente, $status);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
};

function buscarValorProduto($conexao, $idproduto) {
    $sql = "SELECT valor FROM produto WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idproduto);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $valor);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $valor;
}

function deletarVenda($conexao, $idvenda) {
    $sql = "DELETE FROM venda WHERE idvenda = ?";
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
    $sql = "SELECT * FROM armazenamento WHERE idingrediente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingredientes);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
};


function salvarItemVenda($conexao, $id_venda, $id_produto, $quantidade, $valor, $observacao) {
    $sql = "INSERT INTO item_venda (idvenda, idproduto, quantidade, valor, observacao) VALUES (?, ?, ?, ?, ?)";

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
    $sql = "INSERT INTO ingrediente (idproduto, idingrediente, quantidade) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'iii', $idproduto, $idingredientes, $quantidade);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}

function listarIngrediente($conexao, $idproduto) {
    $sql = "SELECT * FROM ingrediente WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_itens = [];
    while ($item = mysqli_fetch_assoc($resultado)) {

        
        $id_ingredintes = $item['idingrediente'];
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

function deletarArmazenamento($conexao, $idingrediente) {    
    $sql = "DELETE FROM armazenamento WHERE idingrediente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingrediente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
//testar
};

function salvarArmazenamento($conexao, $nome, $quantidade) {
    $sql = "INSERT INTO armazenamento (nome, quantidade) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'si', $nome, $quantidade);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

// testar

function editarArmazenamento($conexao, $nome, $quantidade, $idingrediente) {
    $sql = "UPDATE armazenamento SET nome=?, quantidade=? WHERE idingrediente=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sii', $nome, $quantidade, $idingrediente);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};
//testar

?>