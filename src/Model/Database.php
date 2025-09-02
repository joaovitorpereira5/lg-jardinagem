<?php
class Database {
   protected $conn;

   public function __construct(){
    $this->connection();
   }

   public function connection(){
    $dbConfig =[
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'root',
        'password' => '',
        'dbname' => 'lgjardinagemdb',
        'charset' => 'utf8mb4'
    ];

    try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $dbConfig['host'],
                $dbConfig['port'],
                $dbConfig['dbname'],
                $dbConfig['charset']
            );

            $this->conn = new PDO(
                $dsn, 
                $dbConfig['username'], 
                $dbConfig['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true
                ]
            );
            
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

   
    

  
     
