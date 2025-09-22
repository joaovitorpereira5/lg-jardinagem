<?php
// PARTE 1: PHP - INÍCIO DA PÁGINA
// ------------------------------------------------------------------

// Inicia a sessão para usar a variável de usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}

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
    <div class="row g-5">
        <div class="col-lg-8">
            <h2 class="text-center text-success fw-bold mb-4">Monte seu Orçamento</h2>

            <?php foreach ($servicos as $categoria => $itens): ?>
                <h3 class="text-success mt-4"><?= htmlspecialchars($categoria) ?></h3>
                <div class="row g-4">
                    <?php foreach ($itens as $s): ?>
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-success text-center"><?= htmlspecialchars($s['nome']) ?></h5>
                                    <p class="card-text flex-grow-1"><?= htmlspecialchars($s['descricao']) ?></p>
                                    <p class="fw-bold">R$ <?= number_format($s['preco'], 2, ',', '.') ?></p>
                                    <button class="btn btn-success add-servico mt-auto"
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
        </div>
        <div class="col-lg-4">
            <div class="p-4 bg-white rounded shadow sticky-top" style="top: 20px;">
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
                    <button type="submit" class="btn btn-primary w-100" id="finalizar-btn">Finalizar Orçamento</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let total = 0;
    const lista = document.getElementById("lista-servicos");
    const totalSpan = document.getElementById("total");
    const formOrcamento = document.getElementById("form-orcamento");

    // Função para adicionar o serviço
    document.querySelectorAll(".add-servico").forEach(btn => {
        btn.addEventListener("click", () => {
            const nome = btn.dataset.nome;
            const preco = parseFloat(btn.dataset.preco);

            // Previne adicionar o mesmo serviço duas vezes (opcional, mas recomendado)
            if (document.querySelector(`#lista-servicos li[data-nome="${nome}"]`)) {
                alert('Este serviço já foi adicionado.');
                return;
            }

            const li = document.createElement("li");
            li.dataset.preco = preco;
            li.dataset.nome = nome; // Adiciona data-nome para checagem
            li.className = "list-group-item d-flex justify-content-between align-items-center";

            li.innerHTML = `
            <span class="me-2">${nome}</span>
            <span>
                R$ ${preco.toFixed(2).replace('.', ',')}
                <button type="button" class="btn btn-danger btn-sm ms-2 remover-servico">X</button>
            </span>
        `;

            lista.appendChild(li);

            total += preco;
            totalSpan.textContent = total.toFixed(2).replace('.', ',');
        });
    });

    // Função para remover o serviço (usando delegação de eventos)
    lista.addEventListener('click', function (event) {
        if (event.target.classList.contains('remover-servico')) {
            const itemParaRemover = event.target.closest('li');
            const precoItem = parseFloat(itemParaRemover.dataset.preco);

            total -= precoItem;
            totalSpan.textContent = total.toFixed(2).replace('.', ',');

            itemParaRemover.remove();
        }
    });

    // Lógica para o botão de finalizar
    formOrcamento.addEventListener('submit', (e) => {
        e.preventDefault();

        const nomeCliente = document.getElementById("cliente-nome").value;
        const emailCliente = document.getElementById("cliente-email").value;
        const telefoneCliente = document.getElementById("cliente-telefone").value;
        const valorTotal = total.toFixed(2);
        const servicosSelecionados = [];

        document.querySelectorAll("#lista-servicos li").forEach(li => {
            const nome = li.dataset.nome;
            const preco = parseFloat(li.dataset.preco);
            servicosSelecionados.push({ nome, preco });
        });

        // Verifica se há serviços no carrinho antes de finalizar
        if (servicosSelecionados.length === 0) {
            alert("Por favor, adicione ao menos um serviço ao orçamento.");
            return;
        }

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