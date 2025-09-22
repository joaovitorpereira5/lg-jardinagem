<?php
// /view/processa.php - O NOSSO NOVO INTERMEDIÁRIO

/**
 * Este arquivo tem uma única responsabilidade: receber os pedidos
 * dos formulários e chamar o arquivo de rota correspondente que está
 * seguro dentro da pasta /src.
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Verifica se é uma ação de login ou cadastro
    if (isset($_POST['form_action']) && $_POST['form_action'] === 'login_cadastro') {
        
        // Inclui o arquivo de rotas de login de forma segura, via servidor
        require_once __DIR__ . '/../src/routes/LoginRoutes.php';
    }
    
    // No futuro, você pode adicionar outros 'if' aqui para processar outros formulários
    // Ex: if (isset($_POST['form_action']) && $_POST['form_action'] === 'contato') { ... }

} else {
    // Se alguém tentar aceder a este arquivo diretamente, redireciona para a home
    define('BASE_URL', '/projeto-tads'); // Ajuste se necessário
    header('Location: ' . BASE_URL . '/view/home.php');
    exit();
}