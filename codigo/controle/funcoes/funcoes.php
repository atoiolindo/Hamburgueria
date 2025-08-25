<?php

function deletarCliente($conexao, $idcliente) {
    $sql = "DELETE FROM tb_cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function listarClientes($conexao) {
    $sql = "SELECT * FROM tb_cliente";
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

function salvarCliente($conexao, $nome, $cpf, $endereco) {
    $sql = "INSERT INTO tb_cliente (nome, cpf, endereco) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $cpf, $endereco);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);
    //retorna o valor do id que acabou de ser inserido

    mysqli_stmt_close($comando);

    return $idcliente;
};

function editarCliente($conexao, $nome, $cpf, $endereco, $idcliente) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, endereco=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $cpf, $endereco, $idcliente);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou; // funcionou é verdadeiro ou falso p ver se funcionou ou nao , ja que é true or false da pra fazer um if
};

function deletarProduto($conexao, $idproduto) {    
    $sql = "DELETE FROM tb_produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false};
};

function listarProdutos($conexao) {
    $sql = "SELECT * FROM tb_produto";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando); 
    $resultado = mysqli_stmt_get_result($comando);

    $lista_produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)){
        $lista_produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $lista_produtos;
};


function salvarProduto($conexao, $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade) {
    $sql = "INSERT INTO tb_produto (nome, tipo, preco_compra, preco_venda, margem_lucro, quantidade) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssdddi', $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};


function editarProduto($conexao, $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade) {   
    $sql = "UPDATE tb_produto SET nome=?, tipo=?, preco_compra=?, preco_venda=?, margem_lucro= ?, quantidade=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    mysqli_stmt_bind_param($comando, 'ssdddii', $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade, $idproduto);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;
};

//desafio
function salvarUsuario($conexao, $nome, $email, $senha) {
    $sql = "INSERT INTO tb_usuario (nome, email, senha) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($comando, 'sss', $nome, $email, $senha_hash);

    $funcionou = mysqli_stmt_execute($comando);

   mysqli_stmt_close($comando);
    return $funcionou;
};
 
function salvarVenda($conexao, $idcliente, $idproduto, $valor_total, $data) {
    $sql = "INSERT INTO tb_venda (idcliente, idproduto, valor_total, data) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'iids', $idcliente, $idproduto, $valor_total, $data);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
};

// retornar uma variável com todos os dados do cliente
function pesquisarClienteId($conexao, $idcliente) {
    $sql = "SELECT * FROM tb_cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $cliente = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $cliente;
};

// retornar uma variável com todos os dados do produto
function pesquisarProdutoId($conexao, $idproduto) {
    $sql = "SELECT * FROM tb_produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
};

//mostrar o nome do cliente ao invés do id
//mostrar o nome do produto ao invés do id

function listarVendas($conexao) {
    // seleciona as vendas
    $sql = "SELECT * FROM tb_venda";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    
    $vendas = [];
    while ($venda = mysqli_fetch_assoc($resultado)) {
        // busca o nome do cliente
        $clienteS = "SELECT nome FROM tb_cliente WHERE idcliente = {$venda['idcliente']}";
        $cliente_resultado = mysqli_query($conexao, $clienteS);
        $cliente = mysqli_fetch_assoc($cliente_resultado);
        
        // busca o nome do produto
        $produtoS = "SELECT nome FROM tb_produto WHERE idproduto = {$venda['idproduto']}";
        $produto_resultado = mysqli_query($conexao, $produtoS);
        $produto = mysqli_fetch_assoc($produto_resultado);

        // adiciona dados p venda
        $venda['nome_cliente'] = $cliente['nome'];
        $venda['nome_produto'] = $produto['nome'];

        // adiciona venda p lista
        $vendas[] = $venda;
    }
    mysqli_stmt_close($comando);
    return $vendas;
}


//function listarVendas($conexao)    $sql = "SELECT * FROM tb_venda";
   // $comando = mysqli_prepare($conexao, $sql);

    //mysqli_stmt_execute($comando); 
   // $resultado = mysqli_stmt_get_result($comando);

   // $lista_vendas = [];
  //  while ($vendas = mysqli_fetch_assoc($resultado)){
   //     $lista_vendas[] = $vendas;
   // }

  //  mysqli_stmt_close($comando);
  //  return $lista_vendas;
//};
?>
 
 



 