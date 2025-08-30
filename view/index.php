<?php
$mainContent = '
<section class="container my-5">
    <h2 class="text-center text-success fw-bold mb-4">Nossos Trabalhos</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="imagens/j3.jpg" class="card-img-top" alt="Jardim 1">
                <div class="card-body">
                    <p class="card-text">Cuidados e Manutenção Completa para Jardins Residenciais.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="imagens/j4.jpg" class="card-img-top" alt="Jardim 2">
                <div class="card-body">
                    <p class="card-text">Projeto de paisagismo em área empresarial, com plantas ornamentais.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="imagens/j9.jpg" class="card-img-top" alt="Jardim 3">
                <div class="card-body">
                    <p class="card-text">Criação de espaço verde em condomínio, com gramado e arbustos.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<h2 class="text-center mb-4 fw-bold text-success">Seu Jardim, nosso cuidado</h2>
<section class="container ">
    <div class="row justify-content-center"> 
        <div class="col-md-9 col-lg-8">
            <div class="conteudo-principal">
                <p>
                 Hoje, atendemos em Campo Mourão e regiões pelo COMCAM, e prestamos serviços de jardinagem para a cooperativa Sicredi. Também participamos de cotações de empresas e instituições como o Sesc. Nossa motivação para seguir nesta profissão vem do meu amor pela jardinagem e do prazer de estar em contato com a terra e a natureza. As pessoas que nos conhecem sabem que podem contar com a LG Jardinagem e nosso comprometimento e dedicação em cada projeto que realizo.
                </p>
            </div>
            <div class="text-center mt-4">
                <a href="#" onclick="abrirWhatsApp()" class="btn btn-success btn-lg mb-4">Faça seu Orçamento Agora!</a>
            </div>
        </div>
    </div>
</section>
';
include './includes/layout.php';
?>