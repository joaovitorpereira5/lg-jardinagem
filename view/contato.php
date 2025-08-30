<?php
$mainContent = '
<section class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">Entre em Contato</h1>
        </div>
    </div>
    <form class="row g-3 needs-validation" novalidate action="processa_form.php" method="POST">
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
            <div class="invalid-feedback">Por favor, informe seu nome.</div>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Informe um e-mail válido.</div>
        </div>
        <div class="col-md-6">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" required>
            <div class="invalid-feedback">Informe seu telefone para contato.</div>
        </div>
        <div class="col-md-6">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" maxlength="9" required>
            <div class="invalid-feedback">Informe seu CEP.</div>
        </div>
        <div class="col-md-6">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
            <div class="invalid-feedback">Informe seu endereço.</div>
        </div>
        <div class="col-md-6">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
            <div class="invalid-feedback">Informe sua cidade.</div>
        </div>
        <div class="col-md-6">
            <label for="servico" class="form-label">Tipo de Serviço</label>
            <select class="form-select" id="servico" name="servico" required>
                <option selected disabled value="">Escolha uma opção...</option>
                <option>Manutenção de Jardim</option>
                <option>Paisagismo</option>
                <option>Outros</option>
            </select>
            <div class="invalid-feedback">Selecione o tipo de serviço desejado.</div>
        </div>
        <div class="col-md-12">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
            <div class="invalid-feedback">Escreva sua mensagem.</div>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-success btn-lg" type="submit">Enviar Mensagem</button>
        </div>
    </form>
</section>
<script>
(() => {
    "use strict";
    const forms = document.querySelectorAll(".needs-validation");
    Array.from(forms).forEach(form => {
        form.addEventListener("submit", event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        }, false);
    });
})();

document.getElementById("cep").addEventListener("blur", function() {
    const cep = this.value.replace(/\D/g, "");
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById("endereco").value = data.logradouro + (data.bairro ? ", " + data.bairro : "") + (data.localidade ? " - " + data.localidade : "");
                } else {
                    document.getElementById("endereco").value = "";
                }
            });
    }
});
</script>
';
include './includes/layout.php';
?>