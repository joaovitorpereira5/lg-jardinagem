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
        $_SESSION["msnLoginError"] = "";
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

            if (strlen($dados['senha']) < 6) {
                $_SESSION["msnLoginError"] = "A senha deve ter pelo menos 6 caracteres.";
                header('Location: ../../view/login.php');
                exit;
            }

            $senha_hash = sha1($dados['senha']);
            $sql = "INSERT INTO usuarios ( email, senha) VALUES (:email,:senha_hash)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha_hash', $senha_hash);
            if ($stmt->execute()) {
                $_SESSION["msnLoginSuccess"] = "Cadastro realizado com sucesso!";
                header("Location: ../../view/cliente.php");
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

    public function validarLogin()
    {

        $_SESSION["msnLoginError"] = "";
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("SELECT usuarios.*,IFNULL(`admin`.id,0) administrador FROM usuarios LEFT join `admin` ON usuarios.id=`admin`.id_usuario where usuarios.email = :email");
            $stmt->bindParam(':email', $email);

            $stmt->execute();


            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $senha_hash = sha1($senha);

            if (
                $user && $senha_hash == $user['senha']
            ) {
                $_SESSION['usuario'] = true;
                if ($user['administrador'] != 0) {
                    $_SESSION['adminLogado'] = true;
                    header("Location: ../../view/adminView.php");
                } else {
                    $_SESSION['adminLogado'] = false;
                    header("Location: ../../view/cliente.php");
                }

                exit;
            } else {
                $_SESSION["msnLoginError"] = "Email ou senha incorretos.";
                header("Location: ../../view/login.php");
                exit;
            }

        } else {
            header("Location: ../../view/login.php");
            exit;
        }
    }
    public function usuarioLogado()
    {
        if (!$this->usuarioLogado()) {
            $this->initSession();
            $_SESSION['msnLoginError'] = "Sessão expirada ou não autenticada";
            header("Location: ../../view/login.php");
        }
        exit();
    }

    public function listarUsuarios()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }







}