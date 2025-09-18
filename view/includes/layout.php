<?php

// Inicia a sessão no topo do seu layout para que a variável $_SESSION funcione
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LG Jardinagem</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="shortcut icon" href="./imagens/icone.png" />
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand img-logo" href="./home.php">
                <img src="./imagens/logo.png" class="img-fluid" alt="LG Jardinagem"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="./home.php">Página Inicial</a></li>
                    <li class="nav-item"><a class="nav-link" href="./serviços.php">Serviços</a></li>
                    <li class="nav-item"><a class="nav-link" href="./sobre.php">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="./orcamento.php">Orçamento</a></li>

                    <?php if (isset($_SESSION['usuario_logado'])): ?>
                        <li class="nav-item">
                            <form action="./logout.php" method="post" class="d-flex">
                                <button type="submit" class="btn text-danger d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right fs-5 me-2"></i>
                                    <span>Sair</span>
                                </button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="./login.php" class="btn btn-success ms-lg-3">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <?php if (isset($mainContent)) echo $mainContent; ?>
    </main>

    <footer class="footer mt-auto">
        <div class="container text-center">
            <img src="./imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
            <div class="redes">
                <a href="https://www.facebook.com/jardins.encontrocomapazinterior" aria-label="Link para o Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/oseias_pereira_vieira" aria-label="Link para o Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" onclick="abrirWhatsApp()" aria-label="Link para o WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p>&copy; <?= date('Y') ?> LG Jardinagem. Todos os direitos reservados.</p>
        </div>
    </footer>

    <a href="#" onclick="abrirWhatsApp()" class="whatsapp-float" aria-label="Abrir conversa no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

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