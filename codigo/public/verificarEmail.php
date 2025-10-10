<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

if (!isset($_POST['email'])) {
    header("Location: esqueciSenha.php");
    exit;
}

$email = $_POST['email'];
$idusuario = verificarEmail($conexao, $email);

if ($idusuario == 0) {
    header("Location: esqueciSenha.php?erro=1");
    exit;
}
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
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
                <input type="text" name="codigo[]" maxlength="1" pattern="\d*" inputmode="numeric" class="codigo" required>
            </div>
            <input type="submit" value="Confirmar" style="margin-top: 20px;">
        </form>
    
        <a href="esqueciSenha.php" class="voltar">Voltar</a>

        <script>
            document.querySelectorAll('.codigo').forEach((input, idx, arr) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1 && idx < arr.length - 1) {
                        arr[idx + 1].focus();
                    }
                });
                input.addEventListener('keydown', function(e) {
                    if (e.key === "Backspace" && this.value === "" && idx > 0) {
                        arr[idx - 1].focus();
                    }
                });
            });

            document.getElementById('codigo-form').addEventListener('submit', function(e) {
                const inputs = document.querySelectorAll('.codigo');
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




o auth provider ver sobre 