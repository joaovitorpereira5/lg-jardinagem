<?php

include_once __DIR__ . '/Database.php';

$db = new Database();
$conn = $db->getConnection();

$sqlOrcamentos = "SELECT id, data_criacao, valor_total, servicos_selecionados FROM orcamentos ORDER BY data_criacao DESC";
$stmtOrcamentos = $conn->prepare($sqlOrcamentos);
$stmtOrcamentos->execute();
$orcamentos = $stmtOrcamentos->fetchAll(PDO::FETCH_ASSOC);
?>


<h1 class="mt-4">Orçamentos Recebidos</h1>

<?php if (empty($orcamentos)): ?>
    <div class="alert alert-info text-center mt-4">
        Nenhum orçamento foi recebido ainda.
    </div>
<?php else: ?>
    <div class="accordion mt-4" id="accordionOrcamentos">
        <?php foreach ($orcamentos as $orcamento): ?>
            <?php
                $detalhes = json_decode($orcamento['servicos_selecionados'], true);
                $info_cliente_array = array_pop($detalhes);
                $info_cliente = $info_cliente_array['info_cliente'] ?? ['nome' => 'Não informado', 'email' => 'Não informado', 'telefone' => 'Não informado'];
                $servicos_contratados = $detalhes;
            ?>
            <div class="accordion-item" id="orcamento-item-<?= $orcamento['id'] ?>">
                <h2 class="accordion-header" id="heading-<?= $orcamento['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $orcamento['id'] ?>">
                        <div class="d-flex justify-content-between flex-wrap w-100 pe-3">
                            <span class="me-3"><strong>Cliente:</strong> <?= htmlspecialchars($info_cliente['nome']) ?></span>
                            <span class="me-3"><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($orcamento['data_criacao'])) ?></span>
                            <span class="text-success fw-bold">R$ <?= number_format($orcamento['valor_total'], 2, ',', '.') ?></span>
                        </div>
                    </button>
                </h2>
                <div id="collapse-<?= $orcamento['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionOrcamentos">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-5">
                                <h5 class="text-success">Dados do Cliente</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Nome:</strong> <?= htmlspecialchars($info_cliente['nome']) ?></li>
                                    <li><strong>Email:</strong> <?= htmlspecialchars($info_cliente['email']) ?></li>
                                    <li><strong>Telefone:</strong> <?= htmlspecialchars($info_cliente['telefone']) ?></li>
                                </ul>
                                <button class="btn btn-outline-danger btn-sm mt-3 delete-btn" 
                                        data-id="<?= $orcamento['id'] ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmDeleteModal">
                                    <i class="fa fa-trash me-2"></i>Excluir Orçamento
                                </button>
                            </div>
                            <div class="col-md-7">
                                <h5 class="text-success">Serviços Contratados</h5>
                                <ul class="list-group">
                                    <?php foreach ($servicos_contratados as $servico): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= htmlspecialchars($servico['nome']) ?>
                                            <span class="badge bg-success rounded-pill">R$ <?= number_format($servico['preco'], 2, ',', '.') ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir este orçamento? Esta ação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sim, Excluir</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    let orcamentoIdParaExcluir = null;

    // Evento que é disparado QUANDO o modal abre
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        // Pega o botão que acionou o modal
        const button = event.relatedTarget;
        // Extrai o ID do atributo data-id do botão
        orcamentoIdParaExcluir = button.getAttribute('data-id');
    });

    // Evento de clique no botão de confirmação DENTRO do modal
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    confirmDeleteBtn.addEventListener('click', function () {
        if (orcamentoIdParaExcluir) {
            // LINHA NOVA (CORRETA)
            fetch('../src/Model/excluirOrcamento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: orcamentoIdParaExcluir }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Se a exclusão foi bem-sucedida, remove o item da tela
                    const itemParaRemover = document.getElementById('orcamento-item-' + orcamentoIdParaExcluir);
                    if (itemParaRemover) {
                        itemParaRemover.remove();
                    }
                    alert(data.message); // Exibe mensagem de sucesso
                } else {
                    alert('Erro: ' + data.message); // Exibe mensagem de erro
                }
                // Esconde o modal
                const modal = bootstrap.Modal.getInstance(confirmDeleteModal);
                modal.hide();
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Ocorreu um erro de comunicação. Tente novamente.');
            });
        }
    });
});
</script>