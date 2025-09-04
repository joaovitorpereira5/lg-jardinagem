<?php
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/LoginModel.php';

class LoginControll
{
  private $loginModel;
  private $db;

  public function __construct()
  {
    $this->loginModel = new LoginModel();
    $this->db = new Database();

  }


  public function cadastrarCliente()
  {
    $conn = $this->db->getConnection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dados = [
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
      ];
      $resultado = $this->loginModel->cadastrarCliente($dados);

      if (!$resultado) {
        return ['success' => false, 'message' => 'Erro ao cadastrar cliente.'];
      }
      return ['success' => true, 'message' => 'Cliente cadastrado com sucesso.'];
    }

    

  }

    public function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION["msnLoginError"])) {
          echo '<div class="alert alert-error">' . $_SESSION["msnLoginError"] . '</div>';
            unset($_SESSION["msnLoginError"]);
        }
        if(isset($_SESSION["msnLoginSuccess"])) {
          echo '<div class="alert alert-success">' . $_SESSION["msnLoginSuccess"] . '</div>';
            unset($_SESSION["msnLoginSuccess"]);
        }
    }

   



}