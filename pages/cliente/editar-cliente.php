<?php
$idCliente = $_GET["idCliente"];
$sql = "SELECT 
            idCliente, 
            UPPER(nomeCliente) AS nomeCliente,
            LOWER(emailCliente) AS emailCliente,
            telefoneCliente,
            CASE
                WHEN sexoCliente = 'F' THEN 'FEMININO'
                WHEN sexoCliente = 'M' THEN 'MASCULINO'
            ELSE
                'NÃO ESPECIFICADO'
            END AS sexoCliente,
            dataNascCliente
        FROM tbcliente
        WHERE idCliente = {$idCliente}";
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar o registro." . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);
?>

<div class="container my-5">
    <header class="text-start mb-4">
        <h2 class="text-light">Editar Cliente</h2>
        <p class="text-white-50">Altere as informações abaixo para atualizar o Cliente</p>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-dark text-light shadow-lg p-4 rounded">
                    <form action="index.php?menuop=atualizar-cliente" method="post">
                        <div class="mb-3">
                            <label for="idCliente" class="form-label">ID</label>
                            <input type="text" id="idCliente" name="idCliente" value="<?= $dados["idCliente"] ?>" class="form-control bg-dark text-light border-secondary" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nomeCliente" class="form-label">Nome</label>
                            <input type="text" id="nomeCliente" name="nomeCliente" value="<?= $dados["nomeCliente"] ?>" class="form-control bg-dark text-light border-secondary" placeholder="Digite o nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail</label>
                            <input type="email" id="emailCliente" name="emailCliente" value="<?= $dados["emailCliente"] ?>" class="form-control bg-dark text-light border-secondary" placeholder="Digite o e-mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone</label>
                            <input type="text" id="telefoneCliente" name="telefoneCliente" value="<?= $dados["telefoneCliente"] ?>" class="form-control bg-dark text-light border-secondary" placeholder="Digite o telefone" required>
                        </div>
                        <div class="mb-3">
                            <label for="sexoCliente" class="form-label">Sexo</label>
                            <select id="sexoCliente" name="sexoCliente" class="form-select bg-dark text-light border-secondary" required>
                                <option value="M" <?= $dados["sexoCliente"] == "MASCULINO" ? "selected" : "" ?>>Masculino</option>
                                <option value="F" <?= $dados["sexoCliente"] == "FEMININO" ? "selected" : "" ?>>Feminino</option>
                                <option value="N" <?= $dados["sexoCliente"] == "NÃO ESPECIFICADO" ? "selected" : "" ?>>Não Especificado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dataNascCliente" class="form-label">Data de Nascimento</label>
                            <input type="date" id="dataNascCliente" name="dataNascCliente" value="<?= $dados["dataNascCliente"] ?>" class="form-control bg-dark text-light border-secondary" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?menuop=cliente';">Cancelar</button>
                            <button type="submit" class="btn btn-success">Atualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 d-flex flex-column align-items-center text-center">
                <img src="img/edit.png" alt="Editar Cliente" class="img-fluid mb-3" style="max-width: 100%; height: auto; max-height: 400px;">
                <h2 class="text-light">Edição de Cliente</h2>
                <p class="text-white-50">Atualize os dados do Cliente no formulário ao lado e clique em "Atualizar Cliente" para salvar as mudanças.</p>
            </div>
        </div>
    </div>
</div>