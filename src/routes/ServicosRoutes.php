<?php

session_start();

require_once __DIR__ . '/../Controll/ServicoController.php';

$controller = new ServicoController();


if (!empty($_SESSION['mnsCadastroErro'])) {
    echo '<div class="alert alert-danger">'.$_SESSION['mnsCadastroErro'].'</div>';
    unset($_SESSION['mnsCadastroErro']);
}
if (!empty($_SESSION['mnsCadastroSucesso'])) {
    echo '<div class="alert alert-success">'.$_SESSION['mnsCadastroSucesso'].'</div>';
    unset($_SESSION['mnsCadastroSucesso']);
}