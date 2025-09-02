<?php

require_once __DIR__ . '/Database.php';
class LoginModel
{

    private string $email;

    private string $senha;

    private $db;

    public function __construct()
    {

        $this->db = new Database();

    }

    public function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function conecxao()
    {
        $conn = $this->db->getConnection();

    }

    public function logar($email, $senha)
    {
        $this->initSession();
        $_SESSION['cliente_logado'] = false;
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM `admin` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $admin = $stmt->fetch();

        if ($admin && password_verify($senha, $admin['senha_hash'])) {
            // Login bem-sucedido
            $_SESSION['cliente_logado'] = true;
            $_SESSION['cliente_id'] = $admin['id'];
            return true;
        } else {
            // Falha no login
            return false;
        }
    }



}