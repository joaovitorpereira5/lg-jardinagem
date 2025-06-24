<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Erro 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="shortcut icon" href="imagens/icone.png" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .erro-icone {
            font-size: 5rem;
            color: #dc3545;
            margin-bottom: 20px;
            animation: pulse 1.2s infinite alternate;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.08); }
        }
        .erro-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 48px 32px 32px 32px;
            margin-top: 60px;
            margin-bottom: 60px;
            max-width: 480px;
        }
        .erro-titulo {
            font-weight: 700;
            color: #dc3545;
        }
        .erro-lead {
            color: #555;
            margin-bottom: 32px;
        }
        .btn-voltar {
            font-weight: bold;
            font-size: 1.1rem;
            padding: 12px 32px;
            border-radius: 30px;
            box-shadow: 0 2px 8px rgba(0,136,68,0.08);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
            </a>
        </div>
    </nav>
    <div class="container d-flex flex-column align-items-center justify-content-center">
        <div class="erro-container text-center">
            <div class="erro-icone">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="display-5 erro-titulo">Ops! Algo deu errado.</h1>
            <p class="lead erro-lead">A página que você procura não existe ou ocorreu um erro inesperado.</p>
            <a href="index.html" class="btn btn-success btn-voltar mt-2"><i class="fas fa-arrow-left me-2"></i>Voltar para a página inicial</a>
        </div>
    </div>
    <footer class="footer">
        <div class="container text-center">
            <img src="imagens/logo.png" class="img-fluid mb-2" alt="LG Jardinagem" />
            <div class="redes">
                <a href="https://www.facebook.com/jardins.encontrocomapazinterior" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/oseias_pereira_vieira" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/5544998543350" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p>&copy; 2025 LG Jardinagem. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>