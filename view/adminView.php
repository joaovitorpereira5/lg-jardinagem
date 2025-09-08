<?php
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/icone.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <title>Painel Administrativo</title>
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #27ae60;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #008844;
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 15px 20px;
            display: block;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        #sidebar ul li a:hover {
            background: #3498db;
        }
        
        #sidebar ul li.active > a {
            background: #3498db;
            border-left: 4px solid #0c2c19ff;
        }
        
        /* Content */
        #content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.7;
        }
        
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -var(--sidebar-width);
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #content {
                margin-left: 0;
            }
            
            #content.active {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
</head>



<body>
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar -->
        <nav id="sidebar" class="text-white">
            <div class="sidebar-header">
                <h3 class="mb-0">LG Jardinagem</h3>
                <p class="text-muted mb-0">Painel Administrativo</p>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="usuarios.php">
                        <i class="bi bi-people me-2"></i> Usuários
                    </a>
                </li>
                <li>
                    <a href="servicos.php">
                        <i class="bi bi-tree me-2"></i> Serviços
                    </a>
                </li>
                <li>
                    <a href="pedidos.php">
                        <i class="bi bi-cart me-2"></i> Pedidos
                    </a>
                </li>
                <li>
                    <a href="agendamentos.php">
                        <i class="bi bi-calendar me-2"></i> Agendamentos
                    </a>
                </li>
                <li>
                    <a href="financeiro.php">
                        <i class="bi bi-currency-dollar me-2"></i> Financeiro
                    </a>
                </li>
                <li>
                    <a href="relatorios.php">
                        <i class="bi bi-graph-up me-2"></i> Relatórios
                    </a>
                </li>
                <li>
                    <a href="configuracoes.php">
                        <i class="bi bi-gear me-2"></i> Configurações
                    </a>
                </li>
                <li class="mt-3">
                    <a href="../logout.php" class="text-danger">
                        <i class="bi bi-box-arrow-right me-2 color: #ffffffff"></i> Sair
                    </a>
                </li>
            </ul>
        </nav>

       
    </div>
   
</body>

</html>