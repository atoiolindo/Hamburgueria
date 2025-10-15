<?php
require_once "../controle/conexao.php";
require_once "../controle/funcoes.php";

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

$token = pegarTokenUnico($conexao, $idusuario);
$nome  = pegarNomeUsuario($conexao, $idusuario);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'liroyasmin@gmail.com';
    $mail->Password   = 'paty2002+';  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('liroyasmin@gmail.com', 'Hamburgueria Pão & Magia');
    $mail->addAddress($email, $nome);

    $mail->isHTML(false);
    $mail->Subject = 'Seu código de verificação';
    $mail->Body    = "Olá $nome,\n\nSeu código de verificação é: $token\n\nDigite esse código na página para continuar.\n\nSe você não solicitou isso, ignore este e-mail.";

    $mail->send();

    header("Location: digitarCodigo.php?email=" ($email));
    exit;

} catch (Exception $e) {
    echo "<p style='color:red;text-align:center;'>Erro ao enviar e-mail: {$mail->ErrorInfo}</p>";
    echo "<p style='text-align:center;'><a href='esqueciSenha.php'>Tentar novamente</a></p>";
    exit;
}
