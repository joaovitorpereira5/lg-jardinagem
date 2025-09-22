<?php
// /src/model/promoverUsuario.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Segurança: Apenas um admin logado pode executar esta ação
if (!isset($_SESSION['admin_id'])) {
    die("Acesso negado.");
}

// Inclui a conexão com o banco de dados
include_once __DIR__ . '/Database.php';

// Verifica se o ID do utilizador foi enviado via POST
if (isset($_POST['id_usuario'])) {
    $id_usuario_para_promover = $_POST['id_usuario'];

    try {
        $db = new Database();
        $conn = $db->getConnection();

        // Insere o ID na tabela 'admin' para promover o utilizador
        $sql = "INSERT INTO admin (id_usuario) VALUES (:id_usuario)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario_para_promover, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Utilizador promovido a administrador com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao promover o utilizador.";
        }

    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = "Erro de banco de dados: " . $e->getMessage();
    }
} else {
    $_SESSION['mensagem_erro'] = "Nenhum ID de utilizador foi fornecido.";
}

// Define a constante de caminho base (ajuste se necessário)
if (!defined('BASE_URL')) {
    define('BASE_URL', '/projeto-tads');
}

// Redireciona de volta para o painel de utilizadores
header("Location: " . BASE_URL . "/view/adminView.php?page=usuarios");
exit();
?>