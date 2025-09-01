function calcular() {
    let total = 0; // começa o valor total em 0

    // pega todos os checkboxes que começam com 'marcado_' e estão marcados
    document.querySelectorAll("input[type=checkbox][id^='marcado_']:checked").forEach(cb => {
        let id = cb.value; // id do produto (vem do value do checkbox)

        // pega o preço do produto pelo span com id "preco_id"
        // o "+" converte o texto para número
        let preco = +document.getElementById('preco_' + id).innerHTML;

        // pega a quantidade do produto pelo input com id "quantidade_id"
        let quantidade = +document.getElementById('quantidade_' + id).value;
        // garante que a quantidade nunca seja menor que 0
        if (quantidade < 0) quantidade = 0;

        // soma ao total (preço * quantidade)
        total += preco * quantidade;
    });

    // coloca o total no campo de texto, formatado com 2 casas decimais
    
    document.getElementById('valor_final').value = total.toFixed(2);
    document.getElementById('mostrar_total').innerText = total.toFixed(2);

}

