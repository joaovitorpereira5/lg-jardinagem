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
    
    // ... outros métodos como tornarAdmin, removerAdmin, listarAdmins ...
    // Lembre-se de corrigir a sintaxe SQL (crases `) em todos eles.

    public function adminLogado(): bool
    {
        // CORRIGIDO: Verifica a sessão em vez de chamar a si mesmo
        return isset($_SESSION['adminLogado']) && $_SESSION['adminLogado'] === true;
    }
    
    public function verificarLogin()
    {
        if (!$this->adminLogado()) {
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
    
    // Este método não é mais necessário, pois o logout é feito em logoutAdmin.php
    /*
    public function logoutAdmin()
    {
        // ...
    }
    */
}