<?php

session_start();

require_once __DIR__ . '/../Model/ServicosModel.php';
require_once __DIR__ . '/../Controll/ServicoController.php';

$servicoModel = new ServicosModel();
$ServicoController = new ServicoController($servicoModel);

if (!empty($_POST["action"]) && $_POST["action"] == 'cadastrar') {

    $ServicoController->cadstrar();

    listarServicos($ServicoController);
    header('Location: ../../view/adminView.php?page=servicos');
    exit;
}


if (!empty($_POST['action']) && $_POST['action'] === 'listar') {
    listarServicos($ServicoController);
    header('Location: ../../view/adminView.php?page=servicos');
    exit;
}
if (!empty($_POST['action']) && $_POST['action'] === 'editar') {
    
    $ServicoController->editar();
    listarServicos($ServicoController);
    header('Location: ../../view/adminView.php?page=servicos');
    exit;
}

if (!empty($_POST['action']) && $_POST['action'] === 'excluir') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $ServicoController->deletar($id);
    }
    listarServicos($ServicoController);
    header('Location: ../../view/adminView.php?page=servicos');
    exit;
}


function listarServicos($ServicoController)
{
    $_SESSION['liataServicos'] = $ServicoController->listar();
}




if (!empty($_SESSION['mnsCadastroErro'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['mnsCadastroErro'] . '</div>';
    unset($_SESSION['mnsCadastroErro']);
} else if (!empty($_SESSION['mnsCadastroSucesso'])) {
    echo '<div class="alert alert-success">' . $_SESSION['mnsCadastroSucesso'] . '</div>';
    unset($_SESSION['mnsCadastroSucesso']);
}