<?php
if (!isset($_GET['email'])) {
    header("Location: esqueciSenha.php");
    exit;
}
$email = $_GET['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificar Código</title>
<link rel="stylesheet" href="./css/esqueci.css">
</head>
<body>
<div class="container">
    <h1>Verificação de Código</h1>
    <form action="verificarCodigo.php" method="post" id="codigo-form">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <p>Digite o código enviado para seu e-mail:</p>
        <div class="codigo-inputs" style="display: flex; gap: 10px; justify-content: center;">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <input type="text" name="codigo[]" maxlength="1" inputmode="text" class="codigo" required>
            <?php endfor; ?>
        </div>
        <input type="submit" value="Confirmar" style="margin-top: 20px;">
    </form>

    <a href="perfil.php" class="voltar">Voltar</a>

    <script>
// seleciona todos os inputs de código
var inputs = document.querySelectorAll('.codigo');

// para cada input, adiciona comportamento de navegação automática
for (var i = 0; i < inputs.length; i++) {
    (function(idx){
        var input = inputs[idx];

        // quando o usuário digita algo
        input.addEventListener('input', function() {
            // se digitou um caractere e não é o último input
            // muda o foco automaticamente para o próximo input
            if (input.value.length === 1 && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
        });

        // quando o usuário pressiona uma tecla
        input.addEventListener('keydown', function(e) {
            // se pressionou backspace, o input está vazio e não é o primeiro
            // move o foco para o input anterior
            if (e.key === "Backspace" && input.value === "" && idx > 0) {
                inputs[idx - 1].focus();
            }
        });
    })(i); // IIFE para manter o valor correto de idx
}

// ao enviar o formulário
document.getElementById('codigo-form').addEventListener('submit', function(e) {
    var codigo = '';

    // junta os valores de todos os inputs em uma única string
    for (var j = 0; j < inputs.length; j++) {
        codigo += inputs[j].value;
    }

    // cria um input escondido para enviar o código completo como POST
    var hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'codigo';
    hidden.value = codigo;

    // adiciona o input escondido ao formulário antes de enviar
    this.appendChild(hidden);
});
</script>

</div>
</body>
</html>
