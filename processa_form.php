<?php
// Inclui o PHPMailer
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

if (count($erros) > 0) {
    echo "<h3>Erros encontrados:</h3><ul>";
    foreach ($erros as $erro) echo "<li>$erro</li>";
    echo "</ul><a href='contato.html'>Voltar</a>";
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

    echo "<h3>Mensagem enviada com sucesso!</h3><a href='index.html'>Voltar ao site</a>";

} catch (Exception $e) {
    echo "<h3>Erro ao enviar a mensagem:</h3> {$mail->ErrorInfo}";
}
?>
