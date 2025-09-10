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
                             <input type="hidden" name="action" value="editar">
                            <button class="btn btn-primary btn-sm editar-btn" data-id="<?php echo $servico['id']; ?>"
                                data-nome="<?php echo htmlspecialchars($servico['nome']); ?>"
                                data-preco="<?php echo htmlspecialchars($servico['preco']); ?>"
                                data-descricao="<?php echo htmlspecialchars($servico['descricao']); ?>">
                               
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
</div>