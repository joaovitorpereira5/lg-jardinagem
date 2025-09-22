<?php
// /view/logout.php

// Inicia a sessão para poder aceder-lhe
session_start();

// 1. Limpa todas as variáveis da sessão
$_SESSION = array();

// 2. Apaga o cookie da sessão no navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destrói a sessão no servidor
session_destroy();

// 4. Redireciona o usuário para a página de login
// Ajuste o caminho se a sua página de login estiver noutro local
header("Location: login.php");
exit();
?>