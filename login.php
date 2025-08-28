<?php
session_start();
//require 'config/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta na tabela clientes usando o e-mail
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    $cliente = $stmt->fetch();

    if ($cliente && password_verify($senha, $cliente['senha_hash'])) {
        $_SESSION['cliente_logado'] = true;
        $_SESSION['cliente_id'] = $cliente['id'];
        header('Location: cliente/dashboard.php');
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}

$mainContent = '
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4 text-success fw-bold text-center">Login do Cliente</h2>
                    '.(!empty($erro) ? '<div class="alert alert-danger text-center">'.$erro.'</div>' : '').'
                    <form method="POST">
                        <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
                        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>
                        <button type="submit" class="btn btn-success w-100">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
';

include 'includes/layout.php';
?>