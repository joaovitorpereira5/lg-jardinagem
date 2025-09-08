<?php
require_once __DIR__ . '/Database.php';

class Administrador
{
    private int $id;

    private int $id_usuario;



    private $db;

    public function __construct($id_usuario = 0)
    {

        $this->id_usuario = $id_usuario;
        $this->db = new Database();

    }
      public function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    public function setUsuarioId($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function getUsuarioId(): int
    {
        return $this->id_usuario;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function isAdmin(): bool
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT id FROM 'admin' WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $this->id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch() !== false;
        } catch (PDOException $e) {

            return false;
        }
    }

    public function tornarAdmin($id_usuario): bool
    {
        try {
            if ($this->isAdmin()) {
                return false;
            }
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO admin (usuario_id, nivel_acesso) VALUES (:usuario_id");
            $stmt->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
           
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
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
            $stmt = $conn->prepare("SELECT usuario_id, nivel_acesso FROM admin");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

   public function adminLogado(){
     if (!$this->adminLogado()) {
        $this->initSession();
        $_SESSION['msnLoginError'] = "Sessão expirada ou não autenticada";
        header("Location: ../../view/login.php");}
        exit();
 }
          public function criarSessaoAdmin($id_usuario, $email): bool
    {
        try {
            $this->initSession();
            

            $_SESSION['admin_id'] = $id_usuario;
            $_SESSION['admin_email'] = $email;
           
            $_SESSION['adminLogado'] = true;
            $_SESSION['usuarioLogado'] = true; 
            
            return true;
        } catch (Exception $e) {
            error_log("Erro ao criar sessão admin: " . $e->getMessage());
            return false;
        }
    }

    
   
    
    public function redirecionarParaAdmin()
    {
        if ($this->AdminLogado()) {
            header("Location: ../../view/adminView.php");
            exit();
        }
    }
}