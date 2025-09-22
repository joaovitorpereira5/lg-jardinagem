<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../controll/LoginControll.php';

$loginControll = new LoginControll();
$admin = new Administrador();



if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    $_SESSION = array();
    session_destroy();
    header('Location: ../../view/login.php');
    exit;
}
if ($_POST['action'] === 'login') {
    $_SESSION["msnLoginError"] = '';
    $loginControll->fazerLogin();
}

if ($_POST['action'] === 'cadastrar') {

    $loginControll->cadastrarCliente();
}

if (!empty($_POST['action']) && $_POST['action'] === 'listarUsuarios') {
    $usuarios = $loginControll->usuariosListados();
    $_SESSION['listarUsuarios'] = $usuarios;

    header('location: ../../view/adminView.php?page=usuarios');

    exit;
}
if (!empty($_POST['action']) && $_POST['action'] === 'listarAdmins') {
    $admins = $loginControll->listarAmins();
    $_SESSION['listarAdmins'] = $admins;
    header('location: ../../view/adminView.php?page=usuarios');
    exit;
}



if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === true) {
    if (isset($_SESSION['adminLogado']) && $_SESSION['adminLogado'] === true) {
        header("Location ../../adminView.php");
    } else {
        header("Location: ../../cliente.php");
    }
    exit;
}
