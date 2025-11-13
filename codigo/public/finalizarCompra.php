<?php
session_start();

require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idusuario = $_SESSION['idusuario'];
$idcliente = $_SESSION['idcliente'] ?? 0;

if ($idcliente == 0) {
    echo "<p>Por favor, cadastre seu endereço antes de finalizar a compra. <a href='perfil.php'>Ir para perfil</a></p>";
    exit;
}

$cliente = pegarDadosCliente($conexao, $idcliente);


if (empty($_SESSION['carrinho'])) {
    echo "<p>Seu carrinho está vazio. <a href='cardapio.php'>Voltar ao cardápio</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido</title>
    <link rel="stylesheet" href="./css/finalizar.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>
<body>
<div class="container">

    <div class="checkout">

        <div class="col-esquerda">
            <h2>Entrega</h2>
            <div class="bloco">
                <p id="enderecoAtual"><strong><?= htmlspecialchars($cliente['endereco']) ?></strong></p>
                <a href="#" class="trocar" id="btnTrocarEndereco">Trocar</a>

                <div id="campoEndereco">
                    <input id="enderecoInput" type="text" placeholder="Buscar endereço...">
                    <button type="button" id="salvarEndereco">Salvar</button>
                </div>


            </div>



            <h2>Forma de Pagamento</h2>
            <div class="bloco">
                <label>
                    <input type="radio" name="pagamento" checked> Pix
                </label>
            </div>
        </div>

        <div class="col-direita">
            <h2>Resumo do Pedido</h2>
            <div class="card">
                <?php
                $total = 0;
                foreach ($_SESSION['carrinho'] as $id => $quantidade) {
                    $produto = buscarProdutoPorId($conexao, $id);
                    if (!$produto) continue;
                    
                    $subtotal = $produto['valor'] * $quantidade;
                    $total += $subtotal;
                    echo "
                    <div class='item'>
                        <div class='item-nome'>".htmlspecialchars($produto['nome'])."</div>
                        <div class='item-qtd'>Qtd: $quantidade</div>
                        <div class='item-preco'>R$ ".number_format($subtotal, 2, ',', '.')."</div>
                    </div>";
                }
                $taxa_entrega = 5.00;
                $total_final = $total + $taxa_entrega;
                ?>
            </div>

            <div class="resumo-total">
                <div><span>Subtotal</span><span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
                <div><span>Entrega</span><span>R$ <?= number_format($taxa_entrega, 2, ',', '.') ?></span></div>
                <div class="total"><strong>Total</strong><strong>R$ <?= number_format($total_final, 2, ',', '.') ?></strong></div>
            </div>

            <form action="../controle/salvarVenda.php" method="POST">
                <input type="hidden" name="idcliente" value="<?= htmlspecialchars($cliente['idcliente']) ?>">
                <input type="hidden" name="valor_final" value="<?= $total_final ?>">
                <input type="hidden" name="data_compra" value="<?= date('Y-m-d') ?>">
                <input type="hidden" name="status" value="pendente">
                <?php
                foreach ($_SESSION['carrinho'] as $id => $quantidade) {
                    echo "<input type='hidden' name='idproduto[]' value='$id'>";
                    echo "<input type='hidden' name='quantidade[$id]' value='$quantidade'>";
                }
                ?>
                <button type="submit" class="botao-finalizar">Fazer pedido</button>
            </form>

            <a href="carrinho.php" class="voltar">← Voltar ao carrinho</a>
        </div>

    </div>

</div>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.getElementById('btnTrocarEndereco').addEventListener('click', function(e) {
    e.preventDefault();
    const campo = document.getElementById('campoEndereco');
    
    if (campo.style.display === 'none' || campo.style.display === '') {
        campo.style.display = 'block';
        criarMapa();
    } else {
        campo.style.display = 'none';
    }
});

    function criarMapa() {
    if (!document.getElementById('map')) {
        const mapaDiv = document.createElement('div');
        mapaDiv.id = 'map';
        mapaDiv.style.width = '100%';
        mapaDiv.style.height = '300px';
        mapaDiv.style.marginTop = '10px';
        document.getElementById('campoEndereco').appendChild(mapaDiv);
    }

    const coordenadas = [-27.60593, -48.63576];

    const mapa = L.map('map').setView(coordenadas, 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapa);

    const marcador = L.marker(coordenadas, { draggable: true }).addTo(mapa)
        .bindPopup('Rua Luiz Fagundes, 51 - Praia Comprida, São José - SC')
        .openPopup();

    document.getElementById('enderecoInput').value = 'Rua Luiz Fagundes, 51 - Praia Comprida, São José - SC';

    marcador.on('dragend', async function() {
        const pos = marcador.getLatLng();
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${pos.lat}&lon=${pos.lng}&format=json`;
        
        try {
            const resp = await fetch(url);
            const data = await resp.json();
            if (data.display_name) {
                document.getElementById('enderecoInput').value = data.display_name;
            } else {
                document.getElementById('enderecoInput').value = `Lat: ${pos.lat.toFixed(5)}, Lng: ${pos.lng.toFixed(5)}`;
            }
        } catch (e) {
            document.getElementById('enderecoInput').value = `Lat: ${pos.lat.toFixed(5)}, Lng: ${pos.lng.toFixed(5)}`;
        }
    });
}

    document.getElementById('salvarEndereco').addEventListener('click', () => {
    const novoEndereco = document.getElementById('enderecoInput').value.trim();

    if (!novoEndereco) {
        alert('Por favor, selecione ou digite um endereço.');
        return;
    }

    document.getElementById('enderecoAtual').innerHTML = '<strong>' + novoEndereco + '</strong>';
    document.getElementById('campoEndereco').style.display = 'none';
});
</script>

<script src="../controle/funcoes.js"></script>
</body>

</html>
