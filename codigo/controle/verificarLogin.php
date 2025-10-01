<?php
    require_once "conexao.php";
    require_once "funcoes.php";
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $idusuario = verificarLogin($conexao, $email, $senha);
    if ($idusuario == 0) {
        header("Location: ../public/home.php?erro=1");
        exit;
    }
    else {
        $usuario = pegarDadosUsuario($conexao, $idusuario);
        if ($usuario == 0) {
            header("Location: ../public/home.php?erro=1");
            exit;
        }
        else {
            session_start();
            $_SESSION['logado'] = 'sim';
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['idusuario'] = $usuario['idusuario'];
            header("Location: ../public/index.php");
            exit;
        }
    }
?>