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

    //public function validarLogin()
    //{
      //  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //    $email = $_POST['email'];
          //  $senha = $_POST['senha'];
            //$LoginModel = new LoginModel();
            //$LoginModel->initSession();
            //$LoginModel->logar($email, $senha);
            //if ($_SESSION['cliente_logado'] == true) {


              //  header('Location: cliente/dashboard.php');
                //exit;
           // } else {
             //   $erro = "E-mail ou senha incorretos!";
           // }
        //}
    //}

    public function cadastrarCliente(){
         $conn = $this->db->getConnection();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $dados =[
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
            ];
            $resultado = $this->loginModel->cadastrarCliente($dados);
            if (!$resultado){
                return ['success' => false, 'message' => 'Erro ao cadastrar cliente.'];
            }
            return ['success' => true, 'message' => 'Cliente cadastrado com sucesso.'];
        }

        
    }
    
    

}