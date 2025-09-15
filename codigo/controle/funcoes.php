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

function editarProduto($conexao, $nome, $nome_real, $ingredientes, $valor, $tipo, $descricao, $idproduto) {
    $sql = "UPDATE produto SET nome=?, nome_real=?, ingredientes=?, valor=?, tipo=?, descricao=? WHERE idproduto=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'sssdssi', $nome, $nome_real, $ingredientes, $valor, $tipo, $descricao, $idproduto);
        
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


function salvarCliente($conexao, $nome, $telefone, $endereco, $email) {
     // verifica duplicidade
    $sql_check = "SELECT idcliente FROM cliente WHERE telefone=? OR endereco=?";
    $stmt_check = mysqli_prepare($conexao, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 'ss', $telefone, $endereco);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        mysqli_stmt_close($stmt_check);
        return false; // telefone já existe
    }
    mysqli_stmt_close($stmt_check);

    // se não existe, insere
    
    $sql = "INSERT INTO cliente (nome, telefone, endereco, email) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);  
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $telefone, $endereco, $email);
    
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

        // busca os produtos da venda
        $produtosS = "SELECT p.nome, p.foto 
                      FROM item_venda iv
                      INNER JOIN produto p ON iv.idproduto = p.idproduto
                      WHERE iv.idvenda = {$venda['idvenda']}";
        $produtos_resultado = mysqli_query($conexao, $produtosS);

        $produtos = [];
        while ($produto = mysqli_fetch_assoc($produtos_resultado)) {
            $produtos[] = $produto; // nome + foto
        }

        // adiciona dados extras na venda
        $venda['nome_cliente'] = $cliente['nome'];
        $venda['produtos'] = $produtos;

        // adiciona na lista final
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
    $sql = "SELECT valor FROM produto WHERE idproduto = ?";
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

function pesquisarCliente($conexao, $idcliente) {
    $sql = "SELECT * FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $cliente = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $cliente;
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
    $sql = "INSERT INTO ingrediente (idproduto, idingrediente, quantidade)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE quantidade = VALUES(quantidade)";
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

function salvarArmazenamento($conexao, $quantidade, $nome) {
    $sql = "INSERT INTO armazenamento (quantidade, nome) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'is', $quantidade, $nome);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

// testar

function editarArmazenamento($conexao, $quantidade, $nome, $idingrediente) {
    $sql = "UPDATE armazenamento SET quantidade=?, nome=? WHERE idingrediente=?";
    $comando = mysqli_prepare($conexao, $sql);
        
    
    mysqli_stmt_bind_param($comando, 'isi', $quantidade, $nome, $idingrediente);
        
    $funcionou = mysqli_stmt_execute($comando);
        
    mysqli_stmt_close($comando);
    return $funcionou;  
};

function pesquisar($conexao, $nome) {
    $sql = "SELECT nome FROM produto WHERE nome LIKE ?";
    $comando = mysqli_prepare($conexao, $sql);

    $like_nome = "%" . $nome . "%";
    mysqli_stmt_bind_param($comando, 's', $like_nome);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $produtos;
};


function verificarLogin($conexao, $email, $senha) {
    $sql = "SELECT * FROM usuario WHERE email = ?";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 's', $email);

    mysqli_stmt_execute($comando);
    
    $resultado = mysqli_stmt_get_result($comando);
    $quantidade = mysqli_num_rows($resultado);
    
    $iduser = 0;
    if ($quantidade != 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $senha_banco = $usuario['senha'];

        if (password_verify($senha, $senha_banco)) {
            $iduser = $usuario['idusuario'];
        }
    }
    return $iduser;
}

function pegarDadosUsuario($conexao, $idusuario) {
    $sql = "SELECT nome, tipo FROM usuario WHERE idusuario = ?";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $quantidade = mysqli_num_rows($resultado);
    
    if ($quantidade != 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario;
    }
    else {
        return 0;
    }
}


function filtrarValor($conexao, $valor_min, $valor_max) {
    $sql = "SELECT * FROM produto WHERE valor BETWEEN ? AND ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'dd', $valor_min, $valor_max);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $produtos;

}

//testar

function filtrarDisponivel($conexao, $disponivel = true) {
    if ($disponivel) {
        // Seleciona produtos cujos ingredientes estão todos disponíveis
        $sql = "
            SELECT p.*
            FROM produto p
            LEFT JOIN ingrediente i ON p.idproduto = i.idproduto
            LEFT JOIN armazenamento a ON i.idingrediente = a.idingrediente
            GROUP BY p.idproduto
            HAVING SUM(CASE WHEN a.quantidade <= 0 OR a.quantidade IS NULL THEN 1 ELSE 0 END) = 0
        ";
    } else {
        // Seleciona produtos que têm pelo menos um ingrediente indisponível
        $sql = "
            SELECT p.*
            FROM produto p
            LEFT JOIN ingrediente i ON p.idproduto = i.idproduto
            LEFT JOIN armazenamento a ON i.idingrediente = a.idingrediente
            GROUP BY p.idproduto
            HAVING SUM(CASE WHEN a.quantidade <= 0 OR a.quantidade IS NULL THEN 1 ELSE 0 END) > 0
        ";
    }

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $produtos;
}

//testar

function filtrarTipo($conexao, $tipo) {
    $sql = "SELECT * FROM produto WHERE tipo = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 's', $tipo);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $produtos;
};

//testar

function filtrarIngrediente($conexao, $idingrediente) {
    $sql = "
        SELECT p.*
        FROM produto p
        INNER JOIN ingrediente i ON p.idproduto = i.idproduto
        WHERE i.idingrediente = ?
    ";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idingrediente);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $produtos;
};

function adicionarCarrinho($conexao, $id) {
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    if (!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = 1;
    } else {
        $_SESSION['carrinho'][$id]++;
    }
}

function removerCarrinho($conexao, $id) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) {
            unset($_SESSION['carrinho'][$id]);
        }
    }
}

function listarCarrinho($conexao, $produtos) {
    $carrinho = [];
    $total = 0;
    if (!empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $id => $qtd) {
            if (isset($produtos[$id])) {
                $item = $produtos[$id];
                $item['qtd'] = $qtd;
                $item['subtotal'] = $item['valor'] * $qtd;
                $carrinho[] = $item;
                $total += $item['subtotal'];
            }
        }
    }
    return ['itens' => $carrinho, 'total' => $total];
}
//testar

function statusVenda($conexao, $status)
