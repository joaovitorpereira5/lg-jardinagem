<?php
// Lista de serviços fixos (poderia vir do banco depois)
$servicos = [
  "Paisagismo" => [
    ["nome" => "Criação de jardins", "descricao" => "Desenvolvemos jardins personalizados para cada espaço.", "preco" => 500, "imagem" => "./imagens/jardins.jpg"],
    ["nome" => "Escolha de plantas ideais", "descricao" => "Selecionamos as melhores espécies para o seu ambiente.", "preco" => 150, "imagem" => "./imagens/plantas.jpg"],
    ["nome" => "Montagem de canteiros", "descricao" => "Organização de canteiros com estética e praticidade.", "preco" => 200, "imagem" => "./imagens/canteiros.jpg"],
    ["nome" => "Instalação de pedras decorativas", "descricao" => "Aplicação de pedras decorativas para valorizar o jardim.", "preco" => 250, "imagem" => "./imagens/pedras.jpg"],
    ["nome" => "Projeto de caminhos e áreas de descanso", "descricao" => "Criação de caminhos e áreas aconchegantes.", "preco" => 400, "imagem" => "./imagens/caminhos.jpg"],
  ],
  "Jardinagem" => [
    ["nome" => "Corte e aparo de grama", "descricao" => "Manutenção regular da grama com equipamentos adequados.", "preco" => 100, "imagem" => "./imagens/grama.jpg"],
    ["nome" => "Limpeza de folhas e resíduos", "descricao" => "Remoção de folhas secas e resíduos no jardim.", "preco" => 80, "imagem" => "./imagens/limpeza.jpg"],
    ["nome" => "Podas de manutenção", "descricao" => "Podas para manter plantas saudáveis e bem cuidadas.", "preco" => 120, "imagem" => "./imagens/podas.jpg"],
    ["nome" => "Controle de ervas daninhas", "descricao" => "Tratamentos para eliminar ervas invasoras.", "preco" => 90, "imagem" => "./imagens/ervas.jpg"],
    ["nome" => "Adubação e correção de solo", "descricao" => "Uso de adubos e correções para melhorar o solo.", "preco" => 150, "imagem" => "./imagens/adubacao.jpg"],
    ["nome" => "Controle de pragas", "descricao" => "Métodos eficazes para controlar insetos e pragas.", "preco" => 130, "imagem" => "./imagens/pragas.jpg"],
  ]
];

// Monta o conteúdo principal
ob_start();
?>
<div class="container my-5">
  <h2 class="text-center text-success fw-bold mb-4">Monte seu Orçamento</h2>

  <?php foreach($servicos as $categoria => $itens): ?>
    <h3 class="text-success mt-4"><?= $categoria ?></h3>
    <div class="row g-4">
      <?php foreach($itens as $s): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <img src="<?= $s['imagem'] ?>" class="card-img-top" alt="<?= $s['nome'] ?>">
            <div class="card-body">
              <h5 class="card-title text-success"><?= $s['nome'] ?></h5>
              <p class="card-text"><?= $s['descricao'] ?></p>
              <p class="fw-bold">R$ <?= number_format($s['preco'], 2, ',', '.') ?></p>
              <button 
                class="btn btn-success add-servico" 
                data-nome="<?= $s['nome'] ?>" 
                data-preco="<?= $s['preco'] ?>">
                Adicionar ao Orçamento
              </button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <!-- Carrinho -->
  <div class="mt-5 p-4 bg-white rounded shadow">
    <h4 class="text-success">Serviços Selecionados</h4>
    <ul id="lista-servicos" class="list-group mb-3"></ul>
    <h5 class="fw-bold">Total: R$ <span id="total">0,00</span></h5>
    <button class="btn btn-primary">Finalizar Orçamento</button>
  </div>
</div>

<script>
let total = 0;
const lista = document.getElementById("lista-servicos");
const totalSpan = document.getElementById("total");

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
</script>
<?php
$mainContent = ob_get_clean();

// inclui o layout padrão
include __DIR__ . '/includes/layout.php';
