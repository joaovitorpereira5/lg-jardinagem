<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === true) {
    if (isset($_SESSION['adminLogado']) && $_SESSION['adminLogado'] === true) {
        header("Location: ./adminView.php");
    } else {
        header("Location: cliente.php");
    }
    exit;
}


$mainContent = '
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4 text-success fw-bold text-center">Login do Cliente</h2>
                    ' . (!empty($_SESSION["msnLoginError"])  ? '<div class="alert alert-danger text-center">' . $_SESSION["msnLoginError"] . '</div>' : '') . '
                    <form method="POST" action="../src/routes/LoginRoutes.php"> 
                        <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
                        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>
                        <input type="hidden" name="action" value="login">
                        <button type="submit" class="btn btn-success w-100">Entrar</button>
                    </form>
                    <p><a class="link-offset-2 link-underline link-underline-opacity-10 w-100" href="novaConta.php">Criar conta</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
';

include './includes/layout.php';
?>