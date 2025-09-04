<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mainContent = '
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4 text-success fw-bold text-center">Login do Cliente</h2>
                    ' . (!empty($_SESSION["msnLoginError"]) ? '<div class="alert alert-danger text-center">' . $_SESSION["msnLoginError"] . '</div>' : '') . '
                    <form method="POST" action="../src/routes/LoginRoutes.php"> 
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

include './includes/layout.php';
?>