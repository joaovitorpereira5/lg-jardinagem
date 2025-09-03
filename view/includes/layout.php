<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LG Jardinagem</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="shortcut icon" href="./imagens/icone.png" />
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand img-logo" href="./home.php">
      <img src="./imagens/logo.png" class="img-fluid" alt="LG Jardinagem"/>
    </a>

    <!-- Botão hamburguer -->
    <button class="navbar-toggler" style="background-color:#fff" type="button" 
            data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Itens do menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./home.php">Página Inicial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./serviços.php">Serviços</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a href="./login.php" class="btn btn-success ms-lg-3">Login</a>
        </li>
      </ul>
    </div>

  </div>
</nav>


    <?php if (isset($mainContent))
        echo $mainContent; ?>

    <footer class="footer">
        <div class="container text-center">
            <img src="./imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
            <div class="redes">
                <a href="https://www.facebook.com/jardins.encontrocomapazinterior" title="Facebook"><i
                        class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/oseias_pereira_vieira" title="Instagram"><i
                        class="fab fa-instagram"></i></a>
                <a href="#" onclick="abrirWhatsApp()" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p>&copy; 2025 LG Jardinagem. Todos os direitos reservados.</p>
        </div>
    </footer>

    <a href="#" onclick="abrirWhatsApp()" class="whatsapp-float" title="Fale conosco">
        <i class="fab fa-whatsapp"></i>
    </a>
    <script>
        const mensagensWhatsApp = [
            "Olá! Quero informações sobre os serviços da LG Jardinagem."
        ];
        function abrirWhatsApp() {
            const numero = "5544998543350";
            const mensagem = mensagensWhatsApp[0];
            const link = `https://wa.me/${numero}?text=${encodeURIComponent(mensagem)}`;
            window.open(link, '_blank');
        }
    </script>
</body>

</html>