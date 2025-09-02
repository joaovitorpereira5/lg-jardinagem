<?php
require_once 'Administrador.php';

// Criar instância da classe Cadastro
$administro = new Administrador('teste@email.com', 'senha123');

// Testar a conexão
echo $administro->testarConexao();

// Acessar outros métodos
echo "<br>Email: " . $administro->getEmail();
?>