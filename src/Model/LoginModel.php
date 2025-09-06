<?php

require_once __DIR__ . '/Database.php';
class LoginModel
{
    private int $id;
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
    public function getId(): int
    {
        return $this->id;
    }



    public function cadastrarCliente($dados)
    {
        try {
            if (empty($dados['email']) || empty($dados['senha'])) {
                $_SESSION["msnLoginError"] = "Email e senha são obrigatórios.";
                header('Location: ../../view/login.php');
                exit;

            }

            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION["msnLoginError"] = "Email inválido.";
                header('Location: ../../view/login.php');
                exit;


            }

            if (strlen($dados['senha']) < 6) {
                $_SESSION["msnLoginError"] = "A senha deve ter pelo menos 6 caracteres.";



                header('Location: ../../view/login.php');
                exit;
            }

            $emailExiste = $this->verificarEmailExistente($dados['email']);
            if ($emailExiste) {
                $_SESSION["msnLoginError"] = "Email já cadastrado.";
                header('Location: ../../view/login.php');
                exit;
            }



         

            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios ( email, senha) VALUES (:email,:senha_hash)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha_hash', $senha_hash);
            if ($stmt->execute()) {
                $_SESSION["msnLoginSuccess"] = "Cadastro realizado com sucesso!";
                header("Location: ../../view/login.php");
                exit();
            }
            ;
        } catch (PDOException $e) {
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
     public function usuarioLogado(): bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return isset($_SESSION['usuario']) && $_SESSION['usuario'] === true;
    }



   


}