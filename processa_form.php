<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Captura os dados do formulário
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$telefone = trim($_POST['telefone']);
$cep = trim($_POST['cep']);
$endereco = trim($_POST['endereco']);
$cidade = trim($_POST['cidade']);
$servico = trim($_POST['servico']);
$mensagem = trim($_POST['mensagem']);

// Validação simples
$erros = [];

if (empty($nome)) $erros[] = "O nome é obrigatório.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";
if (empty($telefone)) $erros[] = "Telefone obrigatório.";
if (empty($cep)) $erros[] = "CEP obrigatório.";
if (empty($endereco)) $erros[] = "Endereço obrigatório.";
if (empty($cidade)) $erros[] = "Cidade obrigatória.";
if (empty($servico)) $erros[] = "Tipo de serviço obrigatório.";
if (empty($mensagem)) $erros[] = "Mensagem obrigatória.";

function renderHeader() {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>LG Jardinagem - Contato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/contato.css" />
        <link rel="shortcut icon" href="imagens/icone.png" />
    </head>
    <body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Página Inicial</a></li>
                    <li class="nav-item"><a class="nav-link" href="serviços.html">Serviços</a></li>
                    <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="contato.html">Entre em Contato</a></li>
                </ul>
                <a href="#" onclick="abrirWhatsApp()" class="btn btn-success">Faça seu Orçamento</a>
            </div>
        </div>
    </nav>
    <main class="container my-5">
    <?php
}

function renderFooter() {
    ?>
    </main>
    <footer class="footer">
        <div class="container text-center">
            <img src="imagens/logo.png" class="img-fluid mb-2" alt="LG Jardinagem" />
            <div class="redes">
                <a href="https://www.facebook.com/jardins.encontrocomapazinterior" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/oseias_pereira_vieira" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" onclick="abrirWhatsApp()" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p>&copy; 2025 LG Jardinagem. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function abrirWhatsApp() {
        const numero = "5544998543350";
        const mensagem = "Olá! Quero informações sobre os serviços da LG Jardinagem.";
        const link = `https://wa.me/${numero}?text=${encodeURIComponent(mensagem)}`;
        window.open(link, '_blank');
    }
    </script>
    </body>
    </html>
    <?php
}

if (count($erros) > 0) {
    renderHeader();
    echo '<div class="alert alert-danger"><h4>Erros encontrados:</h4><ul>';
    foreach ($erros as $erro) echo "<li>$erro</li>";
    echo '</ul><a href="contato.html" class="btn btn-secondary mt-3">Voltar</a></div>';
    renderFooter();
    exit;
}

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP do Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'joaovitorpereiraquinto58@gmail.com';  
    $mail->Password = 'alei bogi felm mxac';    
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remetente
    $mail->setFrom('joaovitorpereiraquinto58@gmail.com', 'LG Jardinagem');

    // Destinatário (você)
    $mail->addAddress('escofiemichael@gmail.com');

    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = 'Novo contato via site - LG Jardinagem';
    $mail->Body = "
        <h2>Novo contato pelo site</h2>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Telefone:</strong> $telefone</p>
        <p><strong>CEP:</strong> $cep</p>
        <p><strong>Endereço:</strong> $endereco</p>
        <p><strong>Cidade:</strong> $cidade</p>
        <p><strong>Serviço:</strong> $servico</p>
        <p><strong>Mensagem:</strong><br>$mensagem</p>
    ";

    $mail->send();

    renderHeader();
    echo '<div class="alert alert-success text-center"><h3>Mensagem enviada com sucesso!</h3><a href="index.html" class="btn btn-success mt-3">Voltar ao site</a></div>';
    renderFooter();

} catch (Exception $e) {
    renderHeader();
    echo '<div class="alert alert-danger text-center"><h3>Erro ao enviar a mensagem:</h3><p>' . $mail->ErrorInfo . '</p><a href="contato.html" class="btn btn-secondary mt-3">Voltar</a></div>';
    renderFooter();
}
?>