<?php
// PARTE 1: PHP - INÍCIO DO SCRIPT
// ------------------------------------------------------------------

// Inicia a sessão para identificar o usuário logado
session_start();

// Inclui a classe de conexão com o banco de dados
// O caminho foi ajustado para encontrar o arquivo no mesmo diretório
include_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados enviados pelo JavaScript (via POST)
    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input)) {
        echo "Erro: Nenhum dado foi recebido.";
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'] ?? null; // Usa null se o usuário não estiver logado

    // Pega os dados do cliente enviados pelo JavaScript
    $nome_cliente = $input['nome'] ?? null;
    $email_cliente = $input['email'] ?? null;
    $telefone_cliente = $input['telefone'] ?? null;
    $valor_total = $input['valor_total'] ?? 0;
    
    // Pega os serviços e adiciona as informações do cliente ao array antes de codificar em JSON
    $servicos_selecionados = $input['servicos_selecionados'] ?? [];

    // Adiciona as informações do cliente ao array de serviços
    // Isso evita alterar a estrutura do banco de dados
    $servicos_selecionados[] = [
        'info_cliente' => [
            'nome' => $nome_cliente,
            'email' => $email_cliente,
            'telefone' => $telefone_cliente
        ]
    ];

    $servicos_selecionados_json = json_encode($servicos_selecionados);

    // Conecta ao banco de dados
    $db = new Database();
    $conn = $db->getConnection();

    try {
        // PARTE 2: INSERÇÃO NO BANCO DE DADOS
        // ------------------------------------------------------------------
        $sql = "INSERT INTO orcamentos (id_usuario, data_criacao, valor_total, servicos_selecionados) VALUES (:id_usuario, NOW(), :valor_total, :servicos_selecionados)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':valor_total', $valor_total);
        $stmt->bindParam(':servicos_selecionados', $servicos_selecionados_json);
        
        if ($stmt->execute()) {
            echo "Orçamento salvo com sucesso!";
        } else {
            echo "Erro ao salvar o orçamento no banco de dados.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>