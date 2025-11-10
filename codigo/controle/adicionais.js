// ===== Controle de quantidade dos adicionais =====

// Captura todos os botões de "+" e "-"
const botoesMais = document.querySelectorAll('.mais');
const botoesMenos = document.querySelectorAll('.menos');

// Função para alterar quantidade
function alterarQuantidade(id, delta) {
    const input = document.getElementById(`qtd_${id}`);
    if (!input) return;

    let valor = parseInt(input.value);
    valor = Math.max(0, valor + delta); // impede valores negativos
    input.value = valor;
}

// Adiciona eventos aos botões "+"
botoesMais.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        alterarQuantidade(id, 1);
    });
});

// Adiciona eventos aos botões "-"
botoesMenos.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        alterarQuantidade(id, -1);
    });
});

// ===== Salvamento dos adicionais =====
const btnSalvarAdd = document.getElementById('btnSalvarAdd');
const modalAdd = document.getElementById('modalAdicionais');

btnSalvarAdd.addEventListener('click', () => {
    const adicionaisSelecionados = [];

    document.querySelectorAll('[id^="qtd_"]').forEach(input => {
        const qtd = parseInt(input.value);
        if (qtd > 0) {
            const id = input.id.replace('qtd_', '');
            const nome = input.closest('.adicional-item').querySelector('span').textContent;
            adicionaisSelecionados.push({ id, nome, qtd });
        }
    });

    // Mostra um resumo rápido no console (pode ser trocado por outro uso)
    console.log('Adicionais escolhidos:', adicionaisSelecionados);

    // Fecha o modal
    modalAdd.style.display = 'none';
});
