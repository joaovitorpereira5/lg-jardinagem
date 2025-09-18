<?php
// excluirOrcamento.php
session_start();
header('Content-Type: application/json');

// --- ETAPA DE SEGURANÇA CORRIGIDA ---
// Verifica se o admin_id existe na sessão, em vez de adminLogado
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Acesso não autorizado.']);
    exit;
}

include_once __DIR__ . '/Database.php';

// Pega o ID enviado pelo JavaScript
$input = json_decode(file_get_contents('php://input'), true);
$orcamentoId = $input['id'] ?? null;

if (!$orcamentoId) {
    echo json_encode(['success' => false, 'message' => 'ID do orçamento não fornecido.']);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "DELETE FROM orcamentos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $orcamentoId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Orçamento excluído com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Nenhum orçamento encontrado com este ID.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao executar a exclusão.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de banco de dados: ' . $e->getMessage()]);
}
?>