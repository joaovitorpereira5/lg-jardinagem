<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<div class="row">
    <div class="col-md-4">
        <h4>Cadastrar Novo Serviço</h4>
        <?php if (!empty($_SESSION['mnsCadastroErro'])): ?>
            <div class="alert alert-danger text-center">
                <?php
                echo $_SESSION['mnsCadastroErro'];
                unset($_SESSION['mnsCadastroErro']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['mnsCadastroSucesso'])): ?>
            <div class="alert alert-success text-center">
                <?php
                echo $_SESSION['mnsCadastroSucesso'];
                unset($_SESSION['mnsCadastroSucesso']);
                ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="../src/routes/ServicosRoutes.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Serviço</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="preço" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" required>
            </div>
            <div class="mb-3">
                <label for="descrição" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <input type="hidden" name="action" value="cadastrar">
            <button type="submit" class="btn btn-success">Cadastrar Serviço</button>
        </form>


    </div>
 </div>
     <div class="col-md-8">
    <br><br><br>
    <h4>Serviços Cadastrados</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($_SESSION['liataServicos'])): ?>
                <?php foreach ($_SESSION['liataServicos'] as $servico): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($servico['nome']); ?></td>
                        <td><?php echo htmlspecialchars($servico['preco']); ?></td>
                        <td><?php echo htmlspecialchars($servico['descricao']); ?></td>
                        <td>

                            <button class="btn btn-primary btn-sm editar-btn" data-bs-toggle="modal"
                                data-bs-target="#modalEditarServico" data-id="<?php echo $servico['id']; ?>">
                                Editar</button>
                            <form method="POST" action="../src/routes/ServicosRoutes.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $servico['id']; ?>">
                                <input type="hidden" name="action" value="excluir">
                                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum serviço cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <form method="POST" action="../src/routes/ServicosRoutes.php" style="display:inline;">
        <input type="hidden" name="action" value="listar">
        <button type="submit" class="btn btn-primary btn-sm editar-btn">Atualizar</button>
    </form>

    <div class="modal fade" id="modalEditarServico" tabindex="-1" aria-labelledby="modalEditarServicoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarServico" method="POST" action="../src/routes/ServicosRoutes.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarServicoLabel">Editar Serviço</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="editar">
                        <input type="hidden" name="id" id="editar-id">
                        <div class="mb-3">
                            <label for="editar-nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editar-nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-preco" class="form-label">Preço</label>
                            <input type="number" class="form-control" id="editar-preco" name="preco" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="editar-descricao" name="descricao" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="hidden" name="action" value="editar">
                        <button type="submit" class="btn btn-success" data-id="<?php echo $servico['id']; ?>"
                            data-nome="<?php echo htmlspecialchars($servico['nome']); ?>"
                            data-preco="<?php echo htmlspecialchars($servico['preco']); ?>"
                            data-descricao="<?php echo htmlspecialchars($servico['descricao']); ?>">
                            Salvar</button>
                    </div>
                </div>
            </form>
        </div>
     </div>
     <script>
        document.querySelectorAll('.editar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                fetch('../src/routes/getServico.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editar-id').value = data.id;
                        document.getElementById('editar-nome').value = data.nome;
                        document.getElementById('editar-preco').value = data.preco;
                        document.getElementById('editar-descricao').value = data.descricao;
                    })
                    .catch(() => {
                        alert('Erro ao buscar dados do serviço.');
                    });
            });
        });
     </script>
     <script>
        document.getElementById('modalEditarServico').addEventListener('hidden.bs.modal', function () {
            document.getElementById('formEditarServico').reset();
        });
     </script>

    </div>
</div>
