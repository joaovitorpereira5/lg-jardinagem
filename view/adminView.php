<?php
session_start();

// --- ROTEAMENTO COM CAMINHOS CORRIGIDOS ---
$page = $_GET['page'] ?? 'dashboard'; 

switch ($page) {
    case 'servicos':
        // Sobe da pasta 'view' (../), entra em 'src/model/' e pega o arquivo
        $_SESSION['pathAdmin'] = __DIR__ . '/../src/model/painelServicos.php';
        break;
        
    case 'orcamentos':
        // Sobe da pasta 'view' (../), entra em 'src/model/' e pega o arquivo
        $_SESSION['pathAdmin'] = __DIR__ . '/../src/model/painelOrcamentos.php';
        break;
        
    default:
        $_SESSION['pathAdmin'] = null;
        break;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/icone.png" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <title>Painel Administrativo</title>
    <style>
        body { background-color: #f8f9fa; }
        #sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 250px; z-index: 1030; background-color: #003519; color: #fff; }
        #main-content { margin-left: 250px; padding: 20px; }
        .sidebar-nav .nav-link { color: rgba(255,255,255,.8); }
        .sidebar-nav .nav-link:hover { color: #fff; background-color: #004a25; }
        .sidebar-nav .nav-link .fa { width: 20px; text-align: center; }
        @media (max-width: 991.98px) {
            #sidebar { display: none; }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <button class="btn btn-dark m-2 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
        <i class="fa fa-bars"></i>
    </button>

    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Painel Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
             <ul class="nav flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link text-dark" href="?page=dashboard"><i class="fa fa-home me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="?page=orcamentos"><i class="fa fa-file-invoice-dollar me-2"></i>Orçamentos</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="?page=servicos"><i class="fa fa-briefcase me-2"></i>Serviços</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="#"><i class="fa fa-users me-2"></i>Usuários</a></li>
                <li class="nav-item mt-auto"><a class="nav-link text-danger" href="logoutAdmin.php"><i class="fa fa-sign-out-alt me-2"></i>Sair</a></li>
            </ul>
        </div>
    </div>

    <div id="sidebar" class="d-none d-lg-flex flex-column p-3">
        <h4 class="text-center">Painel Admin</h4>
        <hr>
        <ul class="nav flex-column sidebar-nav mb-auto">
            <li class="nav-item"><a class="nav-link" href="?page=dashboard"><i class="fa fa-home me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=orcamentos"><i class="fa fa-file-invoice-dollar me-2"></i>Orçamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=servicos"><i class="fa fa-briefcase me-2"></i>Serviços</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-users me-2"></i>Usuários</a></li>
        </ul>
        <hr>
        <a class="nav-link text-danger" href="logoutAdmin.php"><i class="fa fa-sign-out-alt me-2"></i>Sair</a>
    </div>

    <main id="main-content">
        <?php
        if (!empty($_SESSION['pathAdmin']) && file_exists($_SESSION['pathAdmin'])) {
            include $_SESSION['pathAdmin'];
        } else {
            echo "<h1 class='mt-4'>Bem-vindo ao Painel Administrativo</h1>";
            echo "<p>Selecione uma opção no menu lateral para começar.</p>";
        }
        ?>
    </main>
</body>
</html>