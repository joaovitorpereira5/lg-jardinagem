<?php
session_start();

// --- ROTEAMENTO COM CAMINHOS CORRIGIDOS ---
$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'servicos':
        $_SESSION['pathAdmin'] = __DIR__ . '/painelServicos.php';
        break;

    case 'orcamentos':
        $_SESSION['pathAdmin'] = __DIR__ . '/painelOrcamentos.php';
        break;

    case 'usuarios':
        $_SESSION['pathAdmin'] = __DIR__ . '/painelUsuarios.php';
        break;

    default:
        $_SESSION['pathAdmin'] = null;
        break;
}

// Verificar logout
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    header('Location: login.php');
    exit;
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
        body {
            background-color: #f8f9fa;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            z-index: 1030;
            background-color: #003519;
            color: #fff;
            padding: 20px 0;
        }

        #main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, .8);
            padding: 10px 20px;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background-color: #004a25;
        }

        .sidebar-nav .nav-link .fa {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                display: none;
            }

            #main-content {
                margin-left: 0;
            }
        }

        .logout-link {
            margin-top: auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <button class="btn btn-dark m-2 d-lg-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebar">
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
            <ul class="nav flex-column sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="home.php"><i class="fa-solid fa-left-long"> Voltar</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="?page=dashboard"><i class="fa fa-home me-2"></i>Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="?page=orcamentos"><i
                            class="fa fa-file-invoice-dollar me-2"></i>Orçamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="?page=servicos"><i class="fa fa-briefcase me-2"></i>Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="?page=usuarios"><i class="fa fa-users me-2"></i>Usuários</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="?logout=true"><i class="fa fa-sign-out-alt me-2"></i>Sair</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Sidebar para desktop -->
    <div id="sidebar" class="d-none d-lg-flex flex-column">
        <div class="p-3">
            <h4 class="text-center">Painel Admin</h4>
        </div>
        <hr class="my-2">
        <ul class="nav flex-column sidebar-nav mb-auto">
            <li class="nav-item">
            <li class="nav-item">
                <a class="nav-link " href="home.php"><i class="fa-solid fa-left-long"></i> Voltar</a>
            </li>
            <a class="nav-link" href="?page=dashboard"><i class="fa fa-home"></i>Inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=orcamentos"><i class="fa fa-file-invoice-dollar"></i> Orçamentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=servicos"><i class="fa fa-briefcase"></i> Serviços</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=usuarios"><i class="fa fa-users"></i> Usuários</a>
            </li>
        </ul>
        <div class="logout-link">
            <a class="nav-link text-danger" href="?logout=true"><i class="fa fa-sign-out-alt"></i> Sair</a>
        </div>
    </div>

    <main id="main-content">
        <?php
        if (!empty($_SESSION['pathAdmin']) && file_exists($_SESSION['pathAdmin'])) {
            include $_SESSION['pathAdmin'];
        } else {
            echo "<div class='container mt-4'>";
            echo "<h1>Bem-vindo ao Painel Administrativo</h1>";
            echo "<p>Selecione uma opção no menu lateral para começar.</p>";
            echo "</div>";
        }
        ?>
    </main>
</body>

</html>