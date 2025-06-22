<?php
// Email de destino
$destino = "joaovitorpereiraquinto58@gmail.com";

// Capturar os dados
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$telefone = trim($_POST['telefone']);
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
    echo "<h2>Erro ao enviar:</h2>";
    foreach ($erros as $erro) {
        echo "<p>$erro</p>";
    }
    echo "<p><a href='contato.html'>Voltar</a></p>";
    exit;
}

// Envio para o dono
$corpo = "
Novo contato do site LG Jardinagem:

Nome: $nome
E-mail: $email
Telefone: $telefone
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
echo "<h2>Mensagem enviada com sucesso!</h2>";
echo "<p>Obrigado por entrar em contato.</p>";
echo "<p><a href='index.html'>Voltar ao site</a></p>";
?>
