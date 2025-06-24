<?php
// Email de destino
$destino = "joaovitorpereiraquinto58@gmail.com";

// Capturar os dados
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

if (empty($nome)) {
    $erros[] = "O nome é obrigatório.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "E-mail inválido.";
}

if (!preg_match("/^[0-9\-\(\) ]{8,}$/", $telefone)) {
    $erros[] = "Telefone inválido (mínimo 8 dígitos).";
}

if (empty($cep) || !preg_match("/^\d{5}-?\d{3}$/", $cep)) {
    $erros[] = "CEP inválido.";
}

if (empty($endereco)) {
    $erros[] = "Endereço é obrigatório.";
}

if (empty($cidade)) {
    $erros[] = "Cidade é obrigatória.";
}

if (empty($servico)) {
    $erros[] = "Selecione o tipo de serviço.";
}

if (empty($mensagem)) {
    $erros[] = "Escreva sua mensagem.";
}

if (count($erros) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Erro ao enviar</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
                </a>
            </div>
        </nav>
        <div class="container text-center my-5">
            <h2 class="text-danger">Erro ao enviar:</h2>
            <?php foreach ($erros as $erro): ?>
                <p><?= htmlspecialchars($erro) ?></p>
            <?php endforeach; ?>
            <p><a href="contato.html" class="btn btn-success mt-3">Voltar</a></p>
        </div>
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
    </body>
    </html>
    <?php
    exit;
}

// Envio para o dono
$corpo = "
Novo contato do site LG Jardinagem:

Nome: $nome
E-mail: $email
Telefone: $telefone
CEP: $cep
Endereço: $endereco
Cidade: $cidade
Tipo de Serviço: $servico
Mensagem: $mensagem
";

$headersDono = "From: $email";
mail($destino, "Novo contato via site - LG Jardinagem", $corpo, $headersDono);

// Confirmação para o cliente
$corpoCliente = "
Olá $nome,

Recebemos sua mensagem no site da LG Jardinagem.

Resumo da sua solicitação:

Nome: $nome
E-mail: $email
Telefone: $telefone
CEP: $cep
Endereço: $endereco
Cidade: $cidade
Tipo de Serviço: $servico
Mensagem: $mensagem

Em breve entraremos em contato.

Atenciosamente,
LG Jardinagem
";

$headersCliente = "From: $destino";
mail($email, "Confirmação de contato - LG Jardinagem", $corpoCliente, $headersCliente);

// Resposta ao navegador
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagem enviada</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="imagens/logo.png" class="img-fluid" alt="LG Jardinagem" />
            </a>
        </div>
    </nav>
    <div class="container text-center my-5">
        <h2 class="text-success">Mensagem enviada com sucesso!</h2>
        <p>Obrigado por entrar em contato.</p>
        <p><a href="index.html" class="btn btn-success mt-3">Voltar ao site</a></p>
    </div>
    <footer class="footer">
        <div class="container text-center">
            <img src="imagens/logo.png" class="img-fluid mb-2" alt="LG Jardinagem" />
            <div class="redes">
                <a href="https://www.facebook.com/jardins.encontrocomapazinterior" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/oseias_pereira_vieira" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" onclick="abrirWhatsApp()" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p>&copy; 2025 LG Jardinagem. Todos os direitos