<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id_item = $_POST['id'];
    $nova_quantidade = (int) $_POST['quantidade'];

    if ($nova_quantidade < 1) {
        $nova_quantidade = 1;
    }

    if (isset($_SESSION['carrinho'][$id_item])) {
        $_SESSION['carrinho'][$id_item] = $nova_quantidade;
        echo "ok"; 
    } else {
        echo "item_nao_encontrado";
    }
} else {
    echo "dados_invalidos";
}
?>
