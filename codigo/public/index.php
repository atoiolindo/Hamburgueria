<?php
session_start();

$nome_usuario = $_SESSION['nome'] ?? "Usuário";
$tipo_usuario = $_SESSION['tipo'] ?? null;

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburgueria - Home</title>
    <link rel="icon" href="./assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../controle/funcoes.js"></script>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('sideMenu');
            menu.classList.toggle('open');
        }
    </script>

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
                        echo "        <br>";
                    }
                    echo "        <a href='formCliente.php'>Cadastrar novo cliente</a>";
                    echo "        <br>";
                    echo "        <a href='formVenda.php'>Cadastrar nova venda</a>";
                    echo "        <br>";
                    echo "        <a href='formArmazenamento.php'>Cadastrar novo ingrediente</a>";
                    echo "        <br>";
                    echo "    </div>";
                    echo "</div>";
                } ?>

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
                } ?>


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
                            Olá, <?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário' ?>
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

        <div class="banner-vermelho">
            <div class="conteudo-banner">

                <div class="texto-banner">
                    <h1 style="font-family: 'Bevan', serif;">Hamburgueria Pão & Magia</h1><br><br><br>
                    <h4>Hambúrgueres artesanais com ingredientes caseiros deliciosos.</h4><br><br>
                    <a href="cardapio.php" class="btn-cardapio">Peça agora!</a><br><br><br>
                </div>

                <div class="imagem-banner-fundo">
                    <img id="hamburguer-banner" src="assets/hamburguer.png" alt="Hambúrguer delicioso">
                </div>

            </div>
        </div>
    </div>


    <div class="faixa-escura"></div>


    <section id="cardapio" class="secao-cardapio">

        <h2 id="titulo-cardapio">Cardápio Pão & Magia</h2>

        <!-- Bolinhas de categorias -->
        <div class="cardapio-bolinhas">
            <div class="linha-bolinhas">
                <a href="cardapio.php" class="bolinha">Burguer Bovino</a>
                <a href="cardapio.php" class="bolinha">Burguer de Frango</a>
                <a href="cardapio.php" class="bolinha">Burguer Suíno</a>
            </div>
            <div class="linha-bolinhas centralizada">
                <a href="cardapio.php" class="bolinha">Batata Frita</a>
                <a href="cardapio.php" class="bolinha">Bebidas</a>
            </div>
        </div>

        <!-- Cards dos produtos -->
        <div class="mais-pedidos">
            <div class="container mt-4">
                <h4 class="Nome">Nossos Produtos Mais Pedidos</h4>
                <div class="row justify-content-center">
                    <?php
                    include '../controle/conexao.php';

                    $sql = "SELECT idproduto, nome, valor, foto 
                FROM produto 
                WHERE estado = 'ativo' 
                ORDER BY idproduto 
                LIMIT 6";

                    $result = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                <div class="col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card shadow-sm">
                        <img src="../controle/fotos/' . htmlspecialchars($row["foto"]) . '" 
                             class="card-img-top" 
                             alt="' . htmlspecialchars($row["nome"]) . '">

                        <div class="card-body text-center">
                            <h5>' . htmlspecialchars($row["nome"]) . '</h5>
                            <p class="card-text">R$' . number_format($row["valor"], 2, ',', '.') . '</p>';

                            if (!isset($_SESSION['idusuario'])) {
                                echo '<a href="home.php?id=' . urlencode($row['idproduto']) . '" class="btn-cardapio">Ver Produto</a>';
                            } else {
                                echo '<a href="produto.php?id=' . urlencode($row['idproduto']) . '" class="btn-cardapio">Ver Produto</a>';
                            }

                            echo '
                        </div>
                    </div>
                </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Botão final -->
        <div class="botao-centro">
            <a href="cardapio.php" class="btn-botao">Ver todos</a>
        </div>


    </section>


    <h2 style="font-family: 'Bevan', serif; color: #4B1203;">Sobre nós</h2><br>
    <p class="sobre-nos"> Somos apaixonados por hambúrgueres e acreditamos que cada mordida deve ser uma experiência inesquecível. Surgimos
        da vontade de oferecer mais do que refeições rápidas — queremos proporcionar momentos, sabores marcantes e aquele gostinho de quero mais.</p>

    <p class="sobre-nos">Na nossa hamburgueria, unimos ingredientes frescos, carnes selecionadas e receitas autorais, sempre preparados com
        muito carinho e atenção aos detalhes. Nosso ambiente foi pensado para que você se sinta em casa, seja para um almoço descontraído,
        um encontro entre amigos ou um jantar especial.</p>

    <p class="sobre-nos">Aqui, valorizamos a simplicidade e a qualidade. Do pão artesanal às combinações
        criativas de molhos e acompanhamentos, cada item do nosso cardápio é cuidadosamente elaborado para surpreender.</p>

    <div class="botao-centro">
        <a href="historia.php" class="btn-botao">Saiba mais</a> <br><br><br><br>
    </div>


    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const cartIcon = document.getElementById("cartIcon");
        //     const sideCart = document.getElementById("sideCart");
        //     const closeCartBtn = document.getElementById("closeCartBtn");

        //     // Ao clicar no ícone do carrinho, abre ou fecha a sidebar
        //     cartIcon.addEventListener("click", function() {
        //         sideCart.classList.toggle("open");
        //     });

        //     // Fecha a sidebar ao clicar no botão fechar
        //     closeCartBtn.addEventListener("click", function() {
        //         sideCart.classList.remove("open");
        //     });

        //     // Opcional: fechar sidebar ao clicar fora dela (fora do sideCart)
        //     document.addEventListener("click", function(event) {
        //         const isClickInside = sideCart.contains(event.target) || cartIcon.contains(event.target);
        //         if (!isClickInside) {
        //             sideCart.classList.remove("open");
        //         }
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            var menuDropdowns = document.querySelectorAll(".dropdown-btn");
            menuDropdowns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    dropdownContent.style.display =
                        dropdownContent.style.display === "block" ? "none" : "block";
                });
            });

            var profileBtns = document.querySelectorAll(".profile-btn");
            profileBtns.forEach(function(btn) {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    this.nextElementSibling.classList.toggle("show");
                });
            });
        });
    </script>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <img src="logo.png" alt="Logo Pão e Magia" style="width:80px;"><br>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h3>Horários</h3>
                <p>Seg a Sáb: 17:00 às 21:00</p>
                <p>Dom: Fechado</p>
            </div>

            <div class="footer-col">
                <h3>Informações</h3>
                <a href="#">Sobre nós</a><br>
                <a href="#">Política de Privacidade</a><br>
                <p>Rua Luiz Fagundes, 51 - Praia Comprida, São José - SC, 88103-500</p>
            </div>
        </div>

        <p class="copyright">© 2025 Pão e Magia</p>
    </footer>
</body>

</html>