<?php
// Inclui a classe de conexão com o banco de dados
include_once __DIR__ . '/../src/Model/Database.php';

// Conecta ao banco de dados
$db = new Database();
$conn = $db->getConnection();

try {
    // Busca todos os orçamentos no banco de dados, do mais recente para o mais antigo
    $sql = "SELECT id, data_criacao, valor_total, servicos_selecionados FROM orcamentos ORDER BY data_criacao DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $orcamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao buscar orçamentos: " . $e->getMessage();
    exit();
}
?>

<div class="container my-5">
    <h2 class="text-success fw-bold mb-4">Orçamentos Recebidos</h2>
    
    <?php if (empty($orcamentos)): ?>
        <div class="alert alert-info" role="alert">
            Nenhum orçamento encontrado.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="bg-success text-white">
                    <tr>
                        <th scope="col"># ID</th>
                        <th scope="col">Data</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orcamentos as $orcamento): ?>
                        <tr>
                            <td><?= htmlspecialchars($orcamento['id']) ?></td>
                            <td><?= (new DateTime($orcamento['data_criacao']))->format('d/m/Y H:i') ?></td>
                            <td>R$ <?= number_format($orcamento['valor_total'], 2, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-info text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $orcamento['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $orcamento['id'] ?>">
                                    Ver Detalhes
                                </button>
                                <div class="collapse mt-2" id="collapse<?= $orcamento['id'] ?>">
                                    <div class="card card-body">
                                        <?php 
                                            // Decodifica o JSON para exibir os dados
                                            $detalhes = json_decode($orcamento['servicos_selecionados'], true);
                                            if ($detalhes) {
                                                // O último item do array é a info do cliente
                                                $info_cliente = array_pop($detalhes);
                                                echo "<strong>Cliente:</strong> " . htmlspecialchars($info_cliente['info_cliente']['nome']) . "<br>";
                                                echo "<strong>Email:</strong> " . htmlspecialchars($info_cliente['info_cliente']['email']) . "<br>";
                                                echo "<strong>Telefone:</strong> " . htmlspecialchars($info_cliente['info_cliente']['telefone']) . "<br>";
                                                echo "<br><strong>Serviços:</strong><br>";
                                                foreach ($detalhes as $servico) {
                                                    echo "- " . htmlspecialchars($servico['nome']) . " (R$ " . number_format($servico['preco'], 2, ',', '.') . ")<br>";
                                                }
                                            } else {
                                                echo "Detalhes não disponíveis.";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>