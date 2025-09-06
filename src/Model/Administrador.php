<?php
require_once __DIR__ . '/Database.php';

class Administrador
{
    private int $id;

    private int $id_usuario;



    private $db;

    public function __construct($id_usuario = null)
    {
       
        $this->id_usuario = $id_usuario;
        $this->db = new Database();

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
            $stmt = $conn->prepare("SELECT id FROM admin WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $this->id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch() !== false;
        } catch (PDOException $e) {

            return false;
        }
    }

    public function tornarAdmin($id_usuario, $nivel_acesso = 1): bool
    {
        try {
            if ($this->isAdmin()) {
                return false;
            }
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO admin (usuario_id, nivel_acesso) VALUES (:usuario_id, :nivel_acesso)");
            $stmt->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':nivel_acesso', $nivel_acesso, PDO::PARAM_INT);
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
            $stmt = $conn->prepare("DELETE FROM admin WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }


    public function getNivelAcesso(): ?int
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT nivel_acesso FROM admin WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $this->id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? $result['nivel_acesso'] : 0;
        } catch (PDOException $e) {

            return 0;
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

    public function adminLogado(): bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
    }
}