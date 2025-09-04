<?php
require_once __DIR__ . '/Database.php';

Class Administrador{
    private int $id;

    private string $email;

    private string $senha;

    private  $db;

    public function __construct( string $email, string $senha, )
    {$this->email = $email;
    $this->senha = $senha;
    $this->db = new Database();
    
    }

    public function getId(): int 
    {return $this->id;}

	public function getEmail(): string 
    {return $this->email;}

	public function getSenha(): string 
    {return $this->senha;}

	public function getDb() 
    {return $this->db;}

    // public function testarConexao() {
      //  $conn = $this->db->getConnection();
        
      //  try {
            // Query simples para testar
       //     $stmt = $conn->query("SELECT 1 as teste");
       //     $resultado = $stmt->fetch();
            
         //   return "Conexão funcionando! Resultado: " . $resultado['teste'];
            
       // } catch (PDOException $e) {
           // return "Erro na conexão: " . $e->getMessage();
        //}
   // }

	


	

}