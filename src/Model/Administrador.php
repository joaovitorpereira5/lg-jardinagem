<?php
// admin.php
require_once __DIR__ . '/Database.php';

class Administrador
{
    private int $id_usuario;
    private $db;

    public function __construct($id_usuario = 0)
    {
        $this->id_usuario = $id_usuario;
        $this->db = new Database();
        $this->initSession();
    }

    private function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isAdmin(): bool
    {
        try {
            $conn = $this->db->getConnection();
            // CORRIGIDO: Usado crases ` em vez de aspas simples '
            $stmt = $conn->prepare("SELECT id FROM `admin` WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $this->id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
    



    
    public function verificarLogin()
    {
        
    }


    public function removerAdmin($id_usuario): bool
    {
        try {
            if (!$this->isAdmin()) {
                return false;
            }
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("DELETE FROM 'admin' WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }





    public function listarAdmins(): array
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT * FROM 'admin'");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function adminLogado()
    {   $this->initSession();
        if (!isset($_SESSION['adminLogado']) || $_SESSION['adminLogado'] !== true) {
            

            $_SESSION['msnLoginError'] = "Sessão expirada ou não autenticada";
            header("Location: ../../view/login.php");
            exit();
        }
    }

    public function criarSessaoAdmin($id_usuario, $email): bool
    {
        try {
            $_SESSION['admin_id'] = $id_usuario;
            $_SESSION['admin_email'] = $email;
            $_SESSION['adminLogado'] = true;
            $_SESSION['usuarioLogado'] = true; // Talvez queira manter isso separado
            return true;
        } catch (Exception $e) {
            error_log("Erro ao criar sessão admin: " . $e->getMessage());
            return false;
        }
    }

    






   /* public function redirecionarParaAdmin()
    {
        if ($this->adminLogado()) {
            header("Location: ../../view/adminView.php");
            exit();
        }
    }


    public function logoutAdmin()
    {
        $this->initSession();
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_nivel']);
        unset($_SESSION['admin_logado']);
        unset($_SESSION['adminLogado']);
        session_destroy();


        header("Location: ../../view/login.php");
        exit();
>>>>>>> 0bf1314 (att)
    }
    */
}