<?php
session_start();
if (isset($_SESSION['nome'])) {
    $nome_usuario = $_SESSION['nome'];
    $tipo_usuario = $_SESSION['tipo'];
}
else {
    $nome_usuario = "Usuário";
    $tipo_usuario = 0;
}

if ($tipo_usuario == 'c' || $tipo_usuario == 0) {}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hamburgueria - Home</title>
        <link rel="icon" href="./assets/logopaoemagia2.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="./css/index.css">
        <link href="https://fonts.googleapis.com/css2?family=Bevan:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

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

                <a href="carrinho.php" title="Carrinho">
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
        <br><br><br><br>


        <h2 id="titulo-cardapio" style="font-family: 'Bevan', serif; color: #4B1203;">Cardápio Pão & Magia</h2>

        <div class="cardapio-bolinhas">
            <div class="linha-bolinhas">
                <a href="cardapio.php" class="bolinha">Burguer Bovino</a>
                <a href="cardapio.php" class="bolinha">Burguer de Frango</a>
                <a href="cardapio.php" class="bolinha">Burguer Suíno</a>
            </div>
            <div class="linha-bolinhas centralizada">
                <a href="cardapio.php" class="bolinha">Batata Frita</a>
                <a href="cardapio.php" class="bolinha">Refrigerantes</a>
            </div>
        </div>

<section id="mais-pedidos" style="margin-top: 40px;">
    <h2 style="font-family: 'Bevan', serif; color: #4B1203;">Nossos itens mais pedidos</h2> 
    <br><br>

    <div class="container mt-4">
        <div class="row justify-content-start">

            <?php
            // Inclui a conexão com o banco de dados
            include '../controle/conexao.php';

            // Cria o comando SQL
            // Seleciona até 6 produtos que estão com o estado 'ativo'
            $sql = "SELECT idproduto, nome, valor, foto 
                    FROM produto WHERE estado = 'ativo' ORDER BY idproduto LIMIT 6";

            // Executa a consulta SQL
            $result = mysqli_query($conexao, $sql);

            // Verifica se retornou algum resultado
            if (mysqli_num_rows($result) > 0) {

                // Percorre cada produto retornado pelo banco
                while ($row = mysqli_fetch_assoc($result)) {

                    // Exibe um card para cada produto
                    echo '
                    <div class="col-md-4 mb-4 d-flex justify-content-center">
                        <div class="card shadow-sm" style="width: 18rem; border: none; border-radius: 10px;">

                            <!-- Imagem do produto -->
                            <img src="../controle/fotos/' . htmlspecialchars($row["foto"]) . '" 
                                 class="card-img-top" 
                                 alt="' . htmlspecialchars($row["nome"]) . '" 
                                 style="border-top-left-radius: 10px; 
                                        border-top-right-radius: 10px; 
                                        height: 180px; 
                                        object-fit: cover;">

                            <!-- Corpo do card -->
                            <div class="card-body text-center">

                                <!-- Nome do produto -->
                                <h5 style="font-family: \'Bevan\', serif; color: #4B1203;">
                                    ' . htmlspecialchars($row["nome"]) . '
                                </h5>

                                <!-- Valor formatado -->
                                <p class="card-text">
                                    R$' . number_format($row["valor"], 2, ',', '.') . '
                                </p>

                                <!-- Botão que leva à página do produto -->
                                <a href="produto.php?id=' . urlencode($row["idproduto"]) . '" 
                                   class="btn-cardapio">Ver Produto</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                // 🔹 7️⃣ Caso não existam produtos ativos, mostra esta mensagem
                echo '<p>Nenhum produto encontrado.</p>';
            }
            ?>
        </div>
    </div>
</section>

        <br><br>

        <a href="cardapio.php" class="btn-botao">Ver todos os produtos</a> <br><br><br><br>


        <h2 style="font-family: 'Bevan', serif; color: #4B1203;">Sobre nós</h2><br>
        <p class="sobre-nos"> Somos apaixonados por hambúrgueres e acreditamos que cada mordida deve ser uma experiência inesquecível. Surgimos
            da vontade de oferecer mais do que refeições rápidas — queremos proporcionar momentos, sabores marcantes e aquele gostinho de quero mais.</p>

        <p class="sobre-nos">Na nossa hamburgueria, unimos ingredientes frescos, carnes selecionadas e receitas autorais, sempre preparados com
            muito carinho e atenção aos detalhes. Nosso ambiente foi pensado para que você se sinta em casa, seja para um almoço descontraído,
            um encontro entre amigos ou um jantar especial.</p>

        <p class="sobre-nos">Aqui, valorizamos a simplicidade e a qualidade. Do pão artesanal às combinações
            criativas de molhos e acompanhamentos, cada item do nosso cardápio é cuidadosamente elaborado para surpreender.</p>
        <a href="historia.php" class="btn-botao">Saiba mais</a> <br><br><br><br>


        <script>
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
    </body>
    <footer>
        Horários de Funcionamento: <br>
        Segunda a Sábado: 17h - 22h <br>
        Domingo: Fechado<br><br>

        Informações<br>
        Sobre Nós<br>
        Política de Privacidade<br>
        Endereço<br>
        <a href="https://access.workspace.google.com/ServiceNotAllowed?application=960906454010&source=scrip&continue=https://www.google.com/maps/place/Rua%2BLuiz%2BFagund
    es,%2B51%2B-%2BPicadas%2Bdo%2BSul,%2BS%25C3%25A3o%2BJos%25C3%25A9%2B-%2BSC,%2B88104-300/data%3D!4m2!3m1!1s0x9527360529045821:0x780b6dd572a37?sa%3DX%26ved%3D1t:242%
    26ictx%3D111&marker=c79b2205-0fca-4ee3-890a-f2dc68f5874a&pli=1">Rua Luiz Fagundes, 51 - Praia Comprida, São José - SC, 88103-500</a> <br>

    </footer>

    </html>