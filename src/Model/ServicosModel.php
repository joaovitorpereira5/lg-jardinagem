<?php
require_once __DIR__ . '/Database.php';

class ServicosModel
{
    public function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
    }
    private int $id;

    private string $nome;

    private float $preco;
    private string $descricao;

    private $db;


    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }



    public function __construct(float $preco, string $descricao, string $nome )
    {
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->nome = $nome;
        $this->db = new Database();
    }
 
    public function cadstrarServico(){
        try{
            $sql = "INSERT INTO servicos (nome, preco, descricao) VALUES (:nome, :preco, :descricao)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->execute();
            if(empty($this->nome) || empty($this->preco) || empty($this->descricao)){
               $_SESSION["msnServicoError"] = "Todos os campos são obrigatórios.";
            }
            if($stmt->execute()){
                $_SESSION["msnServicoSuccess"] = "Serviço cadastrado com sucesso.";
            }
            
        }catch (PDOException $e) {
            
        }
    }

    public function listarServicos(){
        try{
            $sql =" SELECT * FROM servicos ORDER BY nome";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            
        }
    }

    public function deletarServico($id){
        try{
            $sql = "DELETE FROM servicos WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                $_SESSION["msnServicoSuccess"] = "Serviço deletado com sucesso.";
            };
            
        }catch (PDOException $e) {
            
        }
    }
    public function editarServico($id, $nome, $preco, $descricao){
        try{
            $sql = "UPDATE servicos SET nome = :nome, preco = :preco, descricao = :descricao WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':descricao', $descricao);
           if( $stmt->execute()){
                $_SESSION["msnServicoSuccess"] = "Serviço editado com sucesso.";
           };
            
        }catch (PDOException $e) {
            
        }
    }

}

