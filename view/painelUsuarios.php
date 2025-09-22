<?php
// /src/model/painelUsuarios.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../src/model/Database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    // Query para selecionar APENAS os utilizadores que NÃO SÃO administradores
    $sql_usuarios = "SELECT u.id, u.email 
                     FROM usuarios u
                     LEFT JOIN admin a ON u.id = a.id_usuario
                     WHERE a.id_usuario IS NULL ORDER BY u.id ASC";
    $stmt_usuarios = $conn->prepare($sql_usuarios);
    $stmt_usuarios->execute();
    $usuarios_comuns = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);

    // Query para selecionar APENAS os utilizadores que JÁ SÃO administradores
    $sql_admins = "SELECT u.id, u.email 
                   FROM usuarios u
                   INNER JOIN admin a ON u.id = a.id_usuario ORDER BY u.id ASC";
    $stmt_admins = $conn->prepare($sql_admins);
    $stmt_admins->execute();
    $administradores = $stmt_admins->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao buscar utilizadores: " . $e->getMessage();
    $usuarios_comuns = [];
    $administradores = [];
}
?>

<h1 class="mt-4">Gerir Utilizadores e Permissões</h1>
<hr>

<?php
// Exibe mensagens de sucesso ou erro vindas do promoverUsuario.php
if (isset($_SESSION['mensagem_sucesso'])) {
    echo '<div class="alert alert-success">' . $_SESSION['mensagem_sucesso'] . '</div>';
    unset($_SESSION['mensagem_sucesso']);
}
if (isset($_SESSION['mensagem_erro'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['mensagem_erro'] . '</div>';
    unset($_SESSION['mensagem_erro']);
}
?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-users me-1"></i>
        Utilizadores Comuns (Candidatos a Admin)
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th class="text-center" style="width: 200px;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios_comuns)): ?>
                        <tr>
                            <td colspan="3" class="text-center">Não há utilizadores comuns para promover.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios_comuns as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td class="text-center">
                                    <form action="../src/model/promoverUsuario.php" method="POST">
                                        <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm" title="Tornar Administrador">
                                            <i class="fas fa-user-shield"></i> Promover a Admin
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-user-shield me-1"></i>
        Administradores Atuais
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($administradores)): ?>
                        <tr>
                            <td colspan="2" class="text-center">Nenhum administrador cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($administradores as $admin): ?>
                            <tr>
                                <td><?= htmlspecialchars($admin['id']) ?></td>
                                <td><?= htmlspecialchars($admin['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>