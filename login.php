<?php
session_start();
require 'config/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($senha, $admin['senha_hash'])) {
        $_SESSION['logado'] = true;
        header('Location: admin/dashboard.php');.
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>LG Jardinagem - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="imagens/icone.png" />
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
            <img src="imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Página Inicial</a></li>
                <li class="nav-item"><a class="nav-link" href="serviços.html">Serviços</a></li>
                <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="contato.html">Entre em Contato</a></li>
            </ul>
            <a href="#" onclick="abrirWhatsApp()" class="btn btn-success">Faça seu Orçamento</a>
        </div>
    </div>
</nav>
<main class="container my-5">
    <form method="POST" class="mx-auto" style="max-width:400px;">
        <h2 class="mb-4">Login Administrador</h2>
        <?php if (!empty($erro)) echo '<div class="alert alert-danger">'.$erro.'</div>'; ?>
        <input type="text" name="usuario" class="form-control mb-3" placeholder="Usuário" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>
        <button type="submit" class="btn btn-success w-100">Entrar</button>
    </form>
</main>
<footer class="footer">
    <div class="container text-center">
        <img src="imagens/logo.png" class="img-fluid mb-2" alt="LG Jardinagem" />
        <div class="redes">
            <a href="https://www.facebook.com/jardins.encontrocomapazinterior" title="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/oseias_pereira_vieira" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" onclick="abrirWhatsApp()" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p>&copy; 2025 LG Jardinagem. Todos os direitos reservados.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
function abrirWhatsApp() {
    const numero = "5544998543350";
    const mensagem = "Olá! Quero informações sobre os serviços da LG Jardinagem.";
    const link = `https://wa.me/${numero}?text=${encodeURIComponent(mensagem)}`;
    window.open(link, '_blank');
}
</script>
</body>
</html>