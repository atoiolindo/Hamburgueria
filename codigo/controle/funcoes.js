function calcular() {
    let total = 0;

    // pega todos os checkboxes de produtos
    document.querySelectorAll("input[type=checkbox][id^='marcado_']").forEach(cb => {
        if (cb.checked) {
            let id = cb.value;
            let preco = parseFloat(document.getElementById('preco_' + id).innerText) || 0;
            let qtd = parseFloat(document.getElementById('quantidade_' + id).value) || 0;
            total += preco * qtd;
        }
    });

    document.getElementById('valor_final').value = total.toFixed(2);
    document.getElementById('mostrar_total').innerText = total.toFixed(2);
}

$(document).ready(function() {
            $("form").on("submit", function(e) {
                let data = $("#data").val().trim();
                if (data === "") {
                    alert("⚠️ Por favor, selecione a data da venda.");
                    e.preventDefault(); // bloqueia envio
                    return false;
                }
            });
        });
