<?php
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/icone.png" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="./css/stylesheet" />
    <style>
        /* Sidebar fixo no desktop */
        @media (min-width: 992px) {
            #sidebar {
                position: fixed !important;
                top: 0;
                left: 0;
                height: 100vh;
                width: 250px;
                z-index: 1030;
                display: block !important;
                transform: none !important;
                visibility: visible !important;
                background-color: #343a40;
                color: #fff;
            }

            #main-content {
                margin-left: 250px;
            }

            .sidebar-toggle-btn {
                display: none;
            }
        }

        /* Sidebar oculto no mobile */
        @media (max-width: 991.98px) {
            #sidebar {
                display: none;
            }

            #main-content {
                margin-left: 0;
            }

            .sidebar-toggle-btn {
                display: inline-block;
            }
        }
    </style>
</head>

<body>
    <!-- Botão para abrir sidebar no mobile -->
    <button class="btn btn-dark m-2 sidebar-toggle-btn d-lg-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar Offcanvas para mobile -->
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar"
        aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Painel Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fa fa-home me-2"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fa fa-users me-2"></i>Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fa fa-briefcase me-2"></i>Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fa fa-cog me-2"></i>Configurações</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="#"><i class="fa fa-sign-out-alt me-2"></i>Sair</a>
                </li>
            </ul>
        </div>
    </div>

   
    <div id="sidebar" class="d-none d-lg-block">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Painel Admin</h5>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="fa fa-home me-2"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="fa fa-users me-2"></i>Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="fa fa-briefcase me-2"></i>Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="fa fa-cog me-2"></i>Configurações</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="#"><i class="fa fa-sign-out-alt me-2"></i>Sair</a>
                </li>
            </ul>
        </div>
    </div>

    
    <div class="container" id="main-content">
        <h1 class="mt-4">Bem-vindo ao Painel Administrativo</h1>
        <?php if (!empty($_SESSION['pathAdmin']) && file_exists($_SESSION['pathAdmin'])) {
            include $_SESSION['pathAdmin'];
        } else {
            echo "<p>Selecione uma opção no menu lateral.</p>";
        } ?>
    </div>
</body>

</html>