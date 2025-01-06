<div class="container my-5">
    <header class="text-start mb-4">
        <h2 class="text-light">Cadastro de Cliente</h2>
        <p class="text-white-50">Preencha as informações abaixo para adicionar um novo Cliente</p>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-dark text-light shadow-lg p-4 rounded">
                    <form action="index.php?menuop=inserir-cliente" method="post">
                        <div class="mb-3">
                            <label for="nomeCliente" class="form-label">Nome</label>
                            <input type="text" id="nomeCliente" name="nomeCliente" class="form-control bg-dark text-light border-secondary" placeholder="Digite o nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail</label>
                            <input type="email" id="emailCliente" name="emailCliente" class="form-control bg-dark text-light border-secondary" placeholder="Digite o e-mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone</label>
                            <input type="text" id="telefoneCliente" name="telefoneCliente" class="form-control bg-dark text-light border-secondary" placeholder="Digite o telefone" required>
                        </div>
                        <div class="mb-3">
                            <label for="sexoCliente" class="form-label">Sexo</label>
                            <select id="sexoCliente" name="sexoCliente" class="form-select bg-dark text-light border-secondary" required>
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="N">Não Especificado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dataNascCliente" class="form-label">Data de Nascimento</label>
                            <input type="date" id="dataNascCliente" name="dataNascCliente" class="form-control bg-dark text-light border-secondary" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?menuop=cliente';">Cancelar</button>
                            <button type="submit" class="btn btn-success">Adicionar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-center text-center">
                <img src="img/add.png" alt="Cadastro de Cliente" class="img-fluid mb-3" style="max-width: 100%; height: auto; max-height: 400px;">
                <h2 class="text-light">Bem-vindo!</h2>
                <p class="text-white-50">Gerencie seus Clientes de maneira rápida e eficiente. Cadastre novos Clientes preenchendo os dados no formulário ao lado.</p>
            </div>
        </div>
    </div>
</div>