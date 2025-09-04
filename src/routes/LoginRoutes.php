<?php
if ($_SESSION === null) {
    session_start();
}

require_once __DIR__ . '/../controll/LoginControll.php';

$loginControll = new LoginControll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION["msnLoginError"] = '';
    extract($_POST);
    if (!empty($email) && !empty($senha)) {
        $response = $loginControll->cadastrarCliente();

        if (empty($_SESSION["msnLoginError"])) {
            header('Location: cliente/dashboard.php');
            exit;
        } else {
            $erro = $response['message'];
        }
    } else {
        $erro = 'Por favor, preencha todos os campos.';
    }

    if($_SERVER ['REQUEST_METHOD'] === 'POST') {
        $dados = [
          'email' => $_POST['email'],
          'senha' => $_POST['senha'],
        ];
         
    $Login->cadastrarCliente($dados);
    }
}