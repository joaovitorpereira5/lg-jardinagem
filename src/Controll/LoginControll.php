<?php
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/LoginModel.php';
require_once __DIR__ . '/../Model/Administrador.php';

class LoginControll
{
  private $loginModel;
  private $db;
  private $administrador;

  public function __construct()
  {
    $this->loginModel = new LoginModel();
    $this->db = new Database();
    $this->administrador = new Administrador();


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
        return ['success' => false];
      }
      return ['success' => true];
    }

  }
  public function usuariosListados()
  {
    return $this->loginModel->listarUsuarios();
  }

  public function listarAdmins()
  {
    return $this->administrador->listarAdmins();

    
  }

  public function fazerLogin()
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $this->loginModel->validarLogin();
    }

  }

  public function fazerLogout()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['adminLogado']);
      session_destroy();
      header('Location: ../../view/login.php');
      exit;
    }


  }

  public function processarLogout()
  {
    $this->initSession();
    $_SESSION = array();
    session_destroy();
    header("Location: ../../view/login.php");
    exit();
  }

  public function initSession()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (isset($_SESSION["msnLoginError"])) {
      echo '<div class="alert alert-error">' . $_SESSION["msnLoginError"] . '</div>';
      unset($_SESSION["msnLoginError"]);
    }
    if (isset($_SESSION["msnLoginSuccess"])) {
      echo '<div class="alert alert-success">' . $_SESSION["msnLoginSuccess"] . '</div>';
      unset($_SESSION["msnLoginSuccess"]);
    }
  }


}