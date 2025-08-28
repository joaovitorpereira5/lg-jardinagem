<?php
$mainContent = '
<div class="container d-flex flex-column align-items-center justify-content-center">
    <div class="erro-container text-center" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 48px 32px 32px 32px; margin-top: 60px; margin-bottom: 60px; max-width: 480px;">
        <div class="erro-icone" style="font-size: 5rem; color: #dc3545; margin-bottom: 20px; animation: pulse 1.2s infinite alternate;">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="display-5 erro-titulo" style="font-weight: 700; color: #dc3545;">Ops! Algo deu errado.</h1>
        <p class="lead erro-lead" style="color: #555; margin-bottom: 32px;">A página que você procura não existe ou ocorreu um erro inesperado.</p>
        <a href="index.php" class="btn btn-success btn-voltar mt-2" style="font-weight: bold; font-size: 1.1rem; padding: 12px 32px; border-radius: 30px; box-shadow: 0 2px 8px rgba(0,136,68,0.08);">
            <i class="fas fa-arrow-left me-2"></i>Voltar para a página inicial
        </a>
    </div>
</div>
<style>
@keyframes pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.08); }
}
</style>
';
include 'includes/layout.php';
?>