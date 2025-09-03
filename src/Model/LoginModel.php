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

    public function cadastrarAdimin($email, $senha)
    {
        $conn = $this->db->getConnection();
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO `admin` (email, senha_hash) VALUES (:email, :senha_hash)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha_hash', $senha_hash);
        return $stmt->execute();
    }

    public function cadastrarCliente($dados)
    {
        try {
            if (empty($dados['email']) || empty($dados['senha'])) {
                throw new InvalidArgumentException("Email e senha são obrigatórios.");
            }
            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Email inválido.");
            }
            if (strlen($dados['senha']) < 6) {
                throw new InvalidArgumentException("A senha deve ter pelo menos 6 caracteres.");
            }
            $emailExiste = $this->verificarEmailExistente($dados['email']);
            if ($emailExiste) {
                throw new Exception("Email já cadastrado.");
            }
            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios ( email, senha_hash) VALUES (:email,:senha_hash)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha_hash', $senha_hash);
            return $stmt->execute();
        }catch (PDOException $e) {
            error_log("Erro PDO no cadastro: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Erro no banco de dados: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }
    public function verificarEmailExistente($email)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch() !== false;
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