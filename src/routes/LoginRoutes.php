<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../controll/LoginControll.php';

$loginControll = new LoginControll();
$admin = new Administrador();

if ($_POST['action'] === 'login') {
    $_SESSION["msnLoginError"] = '';
    $loginControll->fazerLogin();
}

if ($_POST['action'] === 'cadastrar') {

    $loginControll->cadastrarCliente();
}



if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === true) {
    if (isset($_SESSION['adminLogado']) && $_SESSION['adminLogado'] === true) {
        header("Location ../../adminView.php");
    } else {
        header("Location: ../../cliente.php");
    }
    exit;
}
