<?php
$mainContent = '
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-success">Nossos Serviços</h2>
    <div class="row">
        <!-- Card Jardinagem -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="imagens/IMG-20250603-WA0015.jpg" class="card-img-top" alt="Jardinagem">
                <div class="card-body">
                    <h5 class="card-title text-success">Jardinagem</h5>
                    <p class="card-text">
                        Cuidar do seu jardim é muito mais do que apenas cortar a grama. Na LG Jardinagem, oferecemos um serviço completo de manutenção de áreas verdes, com atenção aos detalhes e respeito ao meio ambiente.
                    </p>
                    <p>
                        <strong>Serviços:</strong><br>
                        - Corte e aparo de grama<br>
                        - Limpeza de folhas e resíduos<br>
                        - Podas de manutenção<br>
                        - Controle de ervas daninhas<br>
                        - Adubação e correção de solo<br>
                        - Controle de pragas
                    </p>
                    <a href="#" onclick="abrirWhatsApp()" class="btn btn-success">Saiba Mais</a>
                </div>
            </div>
        </div>
        <!-- Card Paisagismo -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="imagens/j1.jpg" class="card-img-top" alt="Paisagismo">
                <div class="card-body">
                    <h5 class="card-title text-success">Paisagismo</h5>
                    <p class="card-text">
                        Um espaço bem planejado transforma a sua casa ou empresa em um ambiente mais acolhedor e bonito. Na LG Jardinagem, criamos projetos de paisagismo personalizados, respeitando o espaço e o desejo de cada cliente.
                    </p>
                    <p>
                        <strong>Serviços:</strong><br>
                        - Criação de jardins<br>
                        - Escolha de plantas ideais<br>
                        - Montagem de canteiros<br>
                        - Instalação de pedras decorativas<br>
                        - Projeto de caminhos e áreas de descanso
                    </p>
                    <a href="#" onclick="abrirWhatsApp()" class="btn btn-success mt-4">Saiba Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>
';
include './includes/layout.php';
?>