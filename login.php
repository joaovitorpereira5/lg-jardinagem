<?php
session_start();
require 'config/db.php';

if ($_POST) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($senha, $admin['senha_hash'])) {
        $_SESSION['logado'] = true;
        header('Location: admin/dashboard.php');
    } else {
        echo "Usuário ou senha incorretos!";
    }
}
?>
<form method="POST">
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>

