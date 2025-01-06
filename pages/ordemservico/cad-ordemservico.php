<?php
// Verifica a conexão com o banco de dados
if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Valida o parâmetro idCliente recebido via GET
if (!isset($_GET["idCliente"]) || !is_numeric($_GET["idCliente"])) {
    die("Erro: Cliente não identificado.");
}

$idCliente = (int)$_GET["idCliente"];

$sql = "SELECT 
            idCliente, 
            UPPER(nomeCliente) AS nomeCliente
        FROM tbcliente
        WHERE idCliente = {$idCliente}";
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar o registro do cliente: " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);

if (!$dados) {
    die("Erro: Cliente não encontrado.");
}
?>

<div class="container my-5">
    <header class="text-start mb-4">
        <h2 class="text-light">Nova Ordem de Serviço</h2>
        <p class="text-white-50">Preencha as informações abaixo para adicionar uma nova Ordem de Serviço</p>
    </header>
    <div class="row">
        <div class="col-lg-6">
            <div class="card bg-dark text-light shadow-lg p-4 rounded">
                <form action="index.php?menuop=inserir-ordemservico" method="post">
                    <input type="hidden" name="idCliente" value="<?= $idCliente ?>">

                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">Cliente</label>
                        <input type="text" id="nomeCliente" name="nomeCliente" 
                               value="<?= htmlspecialchars($dados["nomeCliente"]) ?>" 
                               class="form-control bg-dark text-light border-secondary" 
                               placeholder="Nome do cliente" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="servico" class="form-label">Serviço</label>
                        <input type="text" id="servico" name="servico" 
                               class="form-control bg-dark text-light border-secondary" 
                               placeholder="Digite o serviço" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricaoServico" class="form-label">Descrição</label>
                        <textarea id="descricaoServico" name="descricaoServico" 
                                  class="form-control bg-dark text-light border-secondary" 
                                  rows="5" placeholder="Digite a descrição"></textarea>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="mb-3 flex-fill">
                            <label for="dataEntradaServico" class="form-label">Data Entrada</label>
                            <input type="date" id="dataEntradaServico" name="dataEntradaServico" 
                                   class="form-control bg-dark text-light border-secondary" required>
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="dataSaidaServico" class="form-label">Data Conclusão</label>
                            <input type="date" id="dataSaidaServico" name="dataSaidaServico" 
                                   class="form-control bg-dark text-light border-secondary">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="valorServico" class="form-label">Valor do Serviço</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-light border-secondary">R$</span>
                                <input type="number" id="valorServico" name="valorServico" 
                                       class="form-control bg-dark text-light border-secondary" 
                                       placeholder="150.00" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tipoPagamento" class="form-label">Forma de Pagamento</label>
                            <select id="tipoPagamento" name="tipoPagamento" 
                                class="form-select bg-dark text-light border-secondary" required>
                                <option value="Não informado">Selecione</option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Débito">Débito</option>
                                <option value="Crédito">Crédito</option>
                                <option value="PIX">PIX</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="statusPagamento" class="form-label">Status Pagamento</label>
                            <select id="statusPagamento" name="statusPagamento" 
                                class="form-select bg-dark text-light border-secondary" required>
                                <option value="Não informado">Selecione</option>
                                <option value="Pago">Pago</option>
                                <option value="Pendente">Pendente</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="mb-3 flex-fill">
                            <label for="statusServico" class="form-label">Status</label>
                            <select id="statusServico" name="statusServico" 
                                class="form-select bg-dark text-light border-secondary" required>
                                <option value="Não informado">Selecione</option>
                                <option value="Em Análise">Em Análise</option>
                                <option value="Em Andamento">Em Andamento</option>
                                <option value="Não realizado">Não realizado</option>
                                <option value="Concluído">Concluído</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" 
                                onclick="window.location.href='index.php?menuop=detalhe-cliente&idCliente=<?= $idCliente ?>';">Cancelar</button>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 d-flex flex-column align-items-center text-center">
            <img src="img/Add-tasks.png" alt="Cadastro de Contato" class="img-fluid mb-3" 
                 style="max-width: 100%; height: auto; max-height: 400px;">
            <h2 class="text-light">Bem-vindo!</h2>
            <p class="text-white-50">Gerencie seus contatos de maneira rápida e eficiente. Cadastre novos contatos preenchendo os dados no formulário ao lado.</p>
        </div>
    </div>
</div>
