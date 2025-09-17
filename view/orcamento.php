<?php
// PARTE 1: PHP - INÍCIO DA PÁGINA
// ------------------------------------------------------------------

// Inicia a sessão para usar a variável de usuário logado
session_start();

// Inclui a classe de conexão com o banco de dados
include_once __DIR__ . '/../src/model/Database.php';

// Cria uma nova instância da conexão
$db = new Database();
$conn = $db->getConnection();

// Query para buscar os serviços do banco de dados (apenas nome, descrição e preço)
$sqlServicos = "SELECT nome, descricao, preco FROM servicos ORDER BY nome";
$stmtServicos = $conn->prepare($sqlServicos);
$stmtServicos->execute();
$servicosDoBanco = $stmtServicos->fetchAll(PDO::FETCH_ASSOC);

// Organiza os dados para serem exibidos na página (sem categorização)
$servicos = ['Geral' => []]; // Cria uma única categoria 'Geral'
foreach ($servicosDoBanco as $servico) {
    $servicos['Geral'][] = [
        'nome' => $servico['nome'],
        'descricao' => $servico['descricao'],
        'preco' => $servico['preco'],
    ];
}

// Inicia a captura de saída para o buffer, para incluir no layout final
ob_start();
?>

<div class="container my-5">
    <h2 class="text-center text-success fw-bold mb-4">Monte seu Orçamento</h2>

    <?php foreach($servicos as $categoria => $itens): ?>
        <h3 class="text-success mt-4"><?= htmlspecialchars($categoria) ?></h3>
        <div class="row g-4">
            <?php foreach($itens as $s): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?= htmlspecialchars($s['nome']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($s['descricao']) ?></p>
                            <p class="fw-bold">R$ <?= number_format($s['preco'], 2, ',', '.') ?></p>
                            <button 
                                class="btn btn-success add-servico" 
                                data-nome="<?= htmlspecialchars($s['nome']) ?>" 
                                data-preco="<?= htmlspecialchars($s['preco']) ?>">
                                Adicionar ao Orçamento
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="mt-5 p-4 bg-white rounded shadow">
        <h4 class="text-success">Serviços Selecionados</h4>
        <ul id="lista-servicos" class="list-group mb-3"></ul>
        <h5 class="fw-bold">Total: R$ <span id="total">0,00</span></h5>
        
        <hr class="my-4">
        <h4 class="text-success mt-4">Dados do Cliente</h4>
        
        <form id="form-orcamento">
            <div class="mb-3">
                <label for="cliente-nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="cliente-nome" required>
            </div>
            <div class="mb-3">
                <label for="cliente-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="cliente-email" required>
            </div>
            <div class="mb-3">
                <label for="cliente-telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="cliente-telefone">
            </div>
            <button type="submit" class="btn btn-primary" id="finalizar-btn">Finalizar Orçamento</button>
        </form>
    </div>
</div>

<script>
let total = 0;
const lista = document.getElementById("lista-servicos");
const totalSpan = document.getElementById("total");
const formOrcamento = document.getElementById("form-orcamento");

document.querySelectorAll(".add-servico").forEach(btn => {
    btn.addEventListener("click", () => {
        const nome = btn.dataset.nome;
        const preco = parseFloat(btn.dataset.preco);

        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between";
        li.innerHTML = `${nome} <span>R$ ${preco.toFixed(2).replace('.', ',')}</span>`;
        lista.appendChild(li);

        total += preco;
        totalSpan.textContent = total.toFixed(2).replace('.', ',');
    });
});

// Lógica para o botão de finalizar
formOrcamento.addEventListener('submit', (e) => {
    e.preventDefault(); // Impede o envio padrão do formulário

    // 1. Pegar os dados do formulário
    const nomeCliente = document.getElementById("cliente-nome").value;
    const emailCliente = document.getElementById("cliente-email").value;
    const telefoneCliente = document.getElementById("cliente-telefone").value;

    // 2. Pegar os dados do carrinho
    const valorTotal = total.toFixed(2);
    const servicosSelecionados = [];
    document.querySelectorAll("#lista-servicos li").forEach(li => {
        const nome = li.querySelector('span').previousSibling.textContent.trim();
        const preco = parseFloat(li.querySelector('span').textContent.replace('R$ ', '').replace(',', '.'));
        servicosSelecionados.push({ nome, preco });
    });

    // 3. Enviar todos os dados para o script de salvar via requisição POST
    fetch('../src/Model/salvarOrcamento.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            nome: nomeCliente,
            email: emailCliente,
            telefone: telefoneCliente,
            valor_total: valorTotal,
            servicos_selecionados: servicosSelecionados
        }),
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        window.location.reload(); 
    })
    .catch((error) => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao salvar o orçamento.');
    });
});
</script>

<?php
// PARTE 4: PHP - FINAL DA PÁGINA
// ------------------------------------------------------------------
$mainContent = ob_get_clean();

// Inclui o layout padrão (cabeçalho, rodapé, etc.)
include __DIR__ . '/includes/layout.php';
?>