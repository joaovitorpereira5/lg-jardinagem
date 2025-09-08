<?php
// admin/dashboard.php

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - LG Jardinagem</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: var(--primary);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 20px;
            background: var(--dark);
            text-align: center;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        .menu-item:hover {
            background: var(--secondary);
        }
        
        .menu-item.active {
            background: var(--secondary);
            border-left: 4px solid var(--success);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: between;
            align-items: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: var(--primary);
        }
        
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .table th {
            background: var(--light);
            font-weight: 600;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary { background: var(--secondary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        
        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
        }
        
        .badge-success { background: var(--success); color: white; }
        .badge-warning { background: var(--warning); color: white; }
        .badge-danger { background: var(--danger); color: white; }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>LG Jardinagem</h2>
                <p>Painel Administrativo</p>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item active">
                    📊 Dashboard
                </a>
                <a href="usuarios.php" class="menu-item">
                    👥 Usuários
                </a>
                <a href="servicos.php" class="menu-item">
                    🌿 Serviços
                </a>
                <a href="pedidos.php" class="menu-item">
                    📦 Pedidos
                </a>
                <a href="agendamentos.php" class="menu-item">
                    📅 Agendamentos
                </a>
                <a href="financeiro.php" class="menu-item">
                    💰 Financeiro
                </a>
                <a href="relatorios.php" class="menu-item">
                    📈 Relatórios
                </a>
                <a href="configuracoes.php" class="menu-item">
                    ⚙️ Configurações
                </a>
                <a href="../logout.php" class="menu-item">
                    🚪 Sair
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h1>Dashboard Administrativo</h1>
                <div class="user-info">
                    <span>Bem-vindo, <strong><?php echo $_SESSION['admin_email']; ?></strong></span>
                    <span class="badge badge-success">Nível <?php echo $_SESSION['admin_nivel']; ?></span>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">154</div>
                    <div class="stat-label">Total de Usuários</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">42</div>
                    <div class="stat-label">Pedidos Hoje</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">R$ 8.542</div>
                    <div class="stat-label">Faturamento Mensal</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Agendamentos Pendentes</div>
                </div>
            </div>

            <!-- Últimos Pedidos -->
            <div class="card">
                <h2>Últimos Pedidos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Serviço</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>João Silva</td>
                            <td>Poda de Árvores</td>
                            <td>R$ 250,00</td>
                            <td><span class="badge badge-success">Concluído</span></td>
                            <td>
                                <button class="btn btn-primary">Ver</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Maria Santos</td>
                            <td>Jardinagem Completa</td>
                            <td>R$ 450,00</td>
                            <td><span class="badge badge-warning">Pendente</span></td>
                            <td>
                                <button class="btn btn-primary">Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Gráficos e Métricas -->
            <div class="stats-grid">
                <div class="card">
                    <h3>Faturamento Mensal</h3>
                    <div style="height: 200px; background: #f0f0f0; display: flex; align-items: end; gap: 10px; padding: 20px;">
                        <div style="background: var(--secondary); width: 30px; height: 150px;"></div>
                        <div style="background: var(--success); width: 30px; height: 120px;"></div>
                        <div style="background: var(--warning); width: 30px; height: 90px;"></div>
                    </div>
                </div>
                
                <div class="card">
                    <h3>Serviços Populares</h3>
                    <div style="margin-top: 20px;">
                        <div style="display: flex; justify-content: between; margin: 10px 0;">
                            <span>Poda de Árvores</span>
                            <span>42%</span>
                        </div>
                        <div style="background: #f0f0f0; height: 10px; border-radius: 5px;">
                            <div style="background: var(--secondary); width: 42%; height: 100%; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Scripts simples para interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Ativar menu atual
            const currentPage = window.location.pathname.split('/').pop();
            document.querySelectorAll('.menu-item').forEach(item => {
                if (item.getAttribute('href') === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>