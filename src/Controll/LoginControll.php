<?php
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/LoginModel.php';

class LoginControll{

    private string $email;

    private string $senha;



    public function __construct()
    {

        $this->db = new Database();

    }

    public function validarLogin(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $LoginModel = new LoginModel();
    $LoginModel->initSession();
    $LoginModel->logar($email, $senha);
    if ($_SESSION['cliente_logado'] == true) {


        header('Location: cliente/dashboard.php');
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
    }
}

}