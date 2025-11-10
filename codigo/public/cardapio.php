<?php
session_start();


$nome_usuario = $_SESSION['nome'] ?? "Usuário";
$tipo_usuario = $_SESSION['tipo'] ?? 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="./css/index.css">
        <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/cardapio.css">

        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function toggleMenu() {
                const menu = document.getElementById('sideMenu');
                menu.classList.toggle('open');
            }
        </script>

    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>



        <div class="cabecalho">

            <button class="menu-btn" onclick="toggleMenu()" title="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <nav id="sideMenu" class="side-menu">
                <button class="close-btn" onclick="toggleMenu()" title="Fechar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <ul>
                    <br><br><br>
                    <li><a href="cardapio.php">Cardápio</a></li>


                    <?php
                        if ($tipo_usuario == 'a' || $tipo_usuario == 'b') {

                    echo "<div class='dropdown'>";
                    echo "    <button class='dropdown-btn'>Cadastrar";
                    echo "        <i class='fa fa-caret-down'></i>";
                    echo "    </button>";
                    echo "    <div class='dropdown-container'>";
                    
                    if ($tipo_usuario == 'a') {
                    echo "        <a href='formProduto.php'>Cadastrar novo produto</a>";
                    echo "        <br>";}
                    echo "        <a href='formCliente.php'>Cadastrar novo cliente</a>";
                    echo "        <br>";
                    echo "        <a href='formVenda.php'>Cadastrar nova venda</a>";
                    echo "        <br>";
                    echo "        <a href='formArmazenamento.php'>Cadastrar novo ingrediente</a>";
                    echo "        <br>";
                    echo "    </div>";
                    echo "</div>";
                    }?>

                    <br>
                    
                    <?php
                        if ($tipo_usuario == 'a' || $tipo_usuario == 'b') {

                    echo "<br>";
                    echo "<div class='dropdown'>";
                    echo "    <button class='dropdown-btn'>Listar";
                    echo "        <i class='fa fa-caret-down'></i>";
                    echo "    </button>";
                    echo "    <div class='dropdown-container'>";
                    echo "        <a href='listarProduto.php'>Lista de produtos cadastrados</a>";
                    echo "        <br>";
                    echo "        <a href='listarProdutoInativo.php'>Lista de produtos inativos cadastrados</a>";
                    echo "        <br>";
                    echo "        <a href='listarCliente.php'>Lista de clientes cadastrados</a>";
                    echo "        <br>";
                    echo "        <a href='listarVenda.php'>Lista de vendas cadastrados</a>";
                    echo "        <br>";
                    echo "        <a href='listarArmazenamento.php'>Lista de ingredientes cadastrados</a>";
                    echo "        <br>";
                    echo "        <a href='listarUsuario.php'>Lista de usuários cadastrados</a>";
                    echo "        <br><br>";
                    echo "    </div>";
                    echo "</div>";
                    }?>

                    
                    <li><a href="historia.php">História/Política de Privacidade</a></li>
                </ul>
            </nav>

            <form class="barra-pesquisa" action="pesquisa.php" method="get">
                <button type="submit" title="Pesquisar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="text" name="pesquisa" placeholder="Pesquisar">

            </form>
            <br>
            <div class="icone-pesquisa">
                <?php if (isset($_SESSION['idusuario'])): ?>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-btn" title="Perfil">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="dropdown-content">
                            <div class="dropdown-header">
                                Olá, <?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] :'Usuário' ?>
                            </div>
                      
                            <a href="pedidos.php">Pedidos</a>
                            <a href="pagamento.php">Pagamento</a>
                            <a href="perfil.php">Meus Dados</a>
                            <a href="../controle/deslogar.php">Sair</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="home.php" title="Login">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php endif; ?>

                <a href="carrinho.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

            </div>  

            


    <br>
    <div class="divisoria"></div><br><br>
    <div class="cardapiogeral"><h1 class="titulo">Cárdapio</h1>

    <div class="hamburguer">
    <h2>Hambúrguer</h2>
    <?php
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_produtos = listarProduto($conexao);
    
    if (count($lista_produtos) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="0">
            <tr>
                
            </tr> 
        <?php
        $contador = 0;
        foreach ($lista_produtos as $produto) {
            if (strtolower($produto['tipo']) !== 'hambúrguer') continue;

            
            $idproduto = $produto['idproduto'];
            $nome = $produto['nome'];
            $nome_real = $produto['nome_real'];
            $ingredientes = $produto['ingredientes'];
            $valor = $produto['valor'];
            $tipo = $produto['tipo'];
            $foto = $produto['foto'];
            $descricao = $produto['descricao'];

            if ($contador > 0) {
                echo '<tr><td colspan="6"><div class="rectangle-29"></div></td></tr>';
            }

            echo "<tr class='linha-produto'>";
            echo "<td class='celula-imagem'><img src='../controle/fotos/$foto'></td>";
            echo "<td class='celula-info'>
                    <span class='nome-produto'>$nome</span>
                    <span class='ingredientes-produto'>$ingredientes</span>
                  </td>";
            echo "<td class='celula-preco'>$valor</td>";

            if ($tipo_usuario == 'c') {
                echo '
                <td class="carrinho">
                    <form action="adicionarCarrinho.php" method="post">
                        <input type="hidden" name="idproduto[]" value="' . $idproduto . '">
                        <input type="hidden" name="quantidade[' . $idproduto . ']" value="1">
                        <button type="submit" class="btn-carrinho">
                            <img src="./assets/adicionarcarrinho.png" alt="Adicionar ao carrinho">
                        </button>
                    </form>
                </td>';
            }
            elseif (!isset($_SESSION['idusuario'])) {
                echo '<td class="carrinho"><a href="home.php"><img src="./assets/adicionarcarrinho.png" alt="Fazer login para comprar"></a></td>';
            }
            elseif ($tipo_usuario == 'a') {

                echo '<td class="hover"><a href="formProduto.php?id=' . $idproduto . '"><img src="./assets/editar.png" alt="editar"></a></td>';
                echo '<td class="hover"><a href="../controle/deletarProduto.php?id=' . $idproduto . '"><img src="./assets/excluir.png" alt="excluir"></a></td>';
            }

            echo "</tr>";
            $contador++;

        }
    }
        ?>
        </table>
    </div>
    <div class="outros"> 
        <h2>Outros</h2> <?php
    require_once "../controle/conexao.php";
    require_once "../controle/funcoes.php";

    $lista_produtos = listarProduto($conexao);
    
    if (count($lista_produtos) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="0">  
        <?php
        $contador = 0;
        foreach ($lista_produtos as $produto) {
            if (!in_array(strtolower($produto['tipo']), ['bebida', 'acompanhamento'])) {
            continue; // pula os outros tipos
            }

            $idproduto = $produto['idproduto'];
            $nome = $produto['nome'];
            $nome_real = $produto['nome_real'];
            $ingredientes = $produto['ingredientes'];
            $valor = $produto['valor'];
            $tipo = $produto['tipo'];
            $foto = $produto['foto'];
            $descricao = $produto['descricao'];
            
            if ($contador > 0) {
                echo '<tr><td colspan="6"><div class="rectangle-29"></div></td></tr>';
            }

            echo "<tr>";
            echo "<tr class='linha-produto'>";
            echo "<td class='celula-imagem'><img src='../controle/fotos/$foto'></td>";
            echo "<td class='celula-info'>
                    <span class='nome-produto'>$nome</span>
                    <span class='ingredientes-produto'>$ingredientes</span>
                  </td>";
            echo "<td class='celula-preco'>$valor</td>";
            if ($tipo_usuario == 'c') {
            echo '
            <td class="carrinho">
                <form action="adicionarCarrinho.php" method="post">
                    <input type="hidden" name="idproduto[]" value="' . $idproduto . '">
                    <input type="hidden" name="quantidade[' . $idproduto . ']" value="1">
                    <button type="submit" class="btn-carrinho">
                        <img src="./assets/adicionarcarrinho.png" alt="Adicionar ao carrinho">
                    </button>
                </form>
            </td>';
            }
            
            elseif (!isset($_SESSION['idusuario'])){
                echo '<td class= "carrinho"> <a href="home.php"> <img src="./assets/adicionarcarrinho.png"> </a></td>';
            }
            elseif ($tipo_usuario == 'a') {
                echo '<td class="hover"><a href="formProduto.php?id=' . $idproduto . '"><img src="./assets/editar.png" alt="editar"></a></td>';
                echo '<td class="hover"><a href="../controle/deletarProduto.php?id=' . $idproduto . '"><img src="./assets/excluir.png" alt="excluir"></a></td>';
            }
            echo "</tr>";

            $contador++; 
        }
    }
        ?>
        </table>
    </div>
    </div>
</body>

</html> 