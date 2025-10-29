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
    const inputs = document.querySelectorAll('.codigo');
    inputs.forEach((input, idx, arr) => {
        input.addEventListener('input', () => {
            if(input.value.length === 1 && idx < arr.length - 1) arr[idx + 1].focus();
        });
        input.addEventListener('keydown', (e) => {
            if(e.key === "Backspace" && input.value === "" && idx > 0) arr[idx - 1].focus();
        });
    });

    document.getElementById('codigo-form').addEventListener('submit', function(e){
        let codigo = '';
        inputs.forEach(input => codigo += input.value);
        let hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'codigo';
        hidden.value = codigo;
        this.appendChild(hidden);
    });
    </script>
</div>
</body>
</html>
