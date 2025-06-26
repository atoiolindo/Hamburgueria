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

function editarProduto($conexao, $nome, $quantidade, $ingredientes, $valor, $tipo,$idproduto) {  
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

// testado e funcionando

function editarCliente($conexao, $nome, $telefone, $endereco,  $email, $idcliente) {
    $sql = "UPDATE cliente SET nome=?, telefone=?, endereco=?, email=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $telefone, $endereco, $email, $idcliente );
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; 
};


function salvarUsuario($conexao, $nome, $email, $senha, $tipo) {
    $sql = "INSERT INTO usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $senha_hash, $tipo);

    mysqli_stmt_execute($comando);
    $idusuario = mysqli_insert_id($conexao);

    mysqli_stmt_close($comando);
    return $idusuario;
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

function editarUsuario($conexao, $email, $senha, $nome, $idusuario) {
    $sql = "UPDATE usuario SET email=?, senha=?, nome=? WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssi', $email, $senha, $nome, $idusuario );
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; 
};


function deletarUsuario($conexao, $idusuario) {
    $sql = "DELETE FROM usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idus);
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
        
        // adiciona dados p venda
        $venda['nome_cliente'] = $cliente['nome'];

        // adiciona venda p lista
        $vendas[] = $venda;
    }
    mysqli_stmt_close($comando);
    return $vendas;
}

 
function salvarVenda($conexao, $idcliente, $valor_final, $observacao, $status, $data) {
    $sql = "INSERT INTO venda (idcliente, valor_final, observacao, status, data) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'idsss', $idcliente, $valor_final, $observacao, $status, $data);

    $funcionou = mysqli_stmt_execute($comando);

    // retorna o valor do id que acabou de ser inserido
    $idvenda = mysqli_stmt_insert_id($comando);
    
    mysqli_stmt_close($comando);
    
    return $idvenda;
};


function deletarVenda($conexao, $idvenda) {
    $sql = "DELETE FROM venda WHERE idvenda = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idvenda);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};


function editarVenda($conexao, $idvenda, $valor_final, $observacao, $data, $idcliente, $status) {
    $sql = "UPDATE venda SET valor_final=?, observacao=?, data=?, idcliente=?, status=? WHERE idvenda=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'dssisi', $valor_final, $observacao, $data, $idcliente, $status, $idvenda);
    
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

function pesquisarArmazenamento($conexao, $idingrediente) {
    $sql = "SELECT * FROM armazenamento WHERE idingrediente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingrediente);

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

function salvarIngrediente($conexao, $idproduto, $idingrediente, $quantidade) {
    $sql = "INSERT INTO ingrediente (idproduto, idingrediente, quantidade) VALUES (?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'iii', $idproduto, $idingrediente, $quantidade);

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

        
        $id_ingredientes = $item['idingrediente'];
        $ingredientes = pesquisarArmazenamento($conexao, $id_ingredientes);
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

//testado e funcionando

function deletarArmazenamento($conexao, $idingredientes) {    
    $sql = "DELETE FROM armazenamento WHERE idingredientes = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingredientes);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; 
};    

//testado e funcionando

function salvarArmazenamento($conexao, $nome, $quantidade) {
    $sql = "INSERT INTO produto (nome, quantidade) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'si', $nome, $quantidade);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

//testado e funcionando

function editarArmazenamento($conexao, $nome, $quantidade, $idingrediente) {
    $sql = "UPDATE armazenamento SET nome=?, quantidade=? WHERE idingrediente=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sii', $nome, $quantidade, $idingrediente);

    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};

//testado e funcionando

?>