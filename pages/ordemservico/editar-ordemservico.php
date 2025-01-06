<?php
// Verifica a conexão
if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Valida o parâmetro ID da Ordem de Serviço
if (!isset($_GET["idOrdemServico"]) || !is_numeric($_GET["idOrdemServico"])) {
    die("Erro: Ordem de Serviço não identificada.");
}

$idOrdemServico = (int)$_GET["idOrdemServico"];

$sql = "SELECT 
            os.idOrdemServico,
            os.idCliente,
            c.nomeCliente,
            os.produtoServicoOS AS servico,
            os.descricaoOS AS descricaoServico,
            os.dataEntrada AS dataEntradaServico,
            os.dataSaida AS dataSaidaServico,
            os.valorServico,
            os.tipoPagamento,
            os.statusPagamento,
            os.statusOS AS statusServico
        FROM ordemservico os
        JOIN tbcliente c ON os.idCliente = c.idCliente
        WHERE os.idOrdemServico = {$idOrdemServico}";
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar o registro da ordem de serviço: " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);

if (!$dados) {
    die("Erro: Ordem de Serviço não encontrada.");
}
?>

<div class="container my-5">
    <header class="text-start mb-4">
        <h2 class="text-light">Editar Ordem de Serviço</h2>
        <p class="text-white-50">Altere as informações abaixo para atualizar a Ordem de Serviço</p>
    </header>

    <div class="row">
        <div class="col-lg-6">
            <div class="card bg-dark text-light shadow-lg p-4 rounded">
                <form action="index.php?menuop=atualizar-ordemservico" method="post">
                    <input type="hidden" name="idCliente" value="<?= $dados['idCliente'] ?>">
                    <input type="hidden" name="idOrdemServico" value="<?= $dados["idOrdemServico"] ?>">

                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">Cliente</label>
                        <input type="text" id="nomeCliente" name="nomeCliente"
                            value="<?= htmlspecialchars($dados["nomeCliente"]) ?>"
                            class="form-control bg-dark text-light border-secondary"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="servico" class="form-label">Serviço</label>
                        <input type="text" id="servico" name="servico"
                            value="<?= htmlspecialchars($dados["servico"]) ?>"
                            class="form-control bg-dark text-light border-secondary"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="descricaoServico" class="form-label">Descrição</label>
                        <textarea id="descricaoServico" name="descricaoServico"
                            class="form-control bg-dark text-light border-secondary"
                            rows="5" required><?= htmlspecialchars($dados["descricaoServico"]) ?></textarea>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="mb-3 flex-fill">
                            <label for="dataEntradaServico" class="form-label">Data Entrada</label>
                            <input type="date" id="dataEntradaServico" name="dataEntradaServico"
                                value="<?= $dados["dataEntradaServico"] ?>"
                                class="form-control bg-dark text-light border-secondary"
                                required>
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="dataSaidaServico" class="form-label">Data Conclusão</label>
                            <input type="date" id="dataSaidaServico" name="dataSaidaServico"
                                value="<?= $dados["dataSaidaServico"] ?>"
                                class="form-control bg-dark text-light border-secondary">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="valorServico" class="form-label">Valor do Serviço</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-light border-secondary">R$</span>
                                <input type="number" id="valorServico" name="valorServico"
                                    value="<?= $dados["valorServico"] ?>"
                                    class="form-control bg-dark text-light border-secondary"
                                    step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tipoPagamento" class="form-label">Forma de Pagamento</label>
                            <select id="tipoPagamento" name="tipoPagamento"
                                class="form-select bg-dark text-light border-secondary"
                                required>
                                <option value="Não informado" <?= $dados["tipoPagamento"] == "Não informado" ? "selected" : "" ?>>Selecione</option>
                                <option value="Dinheiro" <?= $dados["tipoPagamento"] == "Dinheiro" ? "selected" : "" ?>>Dinheiro</option>
                                <option value="Débito" <?= $dados["tipoPagamento"] == "Débito" ? "selected" : "" ?>>Débito</option>
                                <option value="Crédito" <?= $dados["tipoPagamento"] == "Crédito" ? "selected" : "" ?>>Crédito</option>
                                <option value="PIX" <?= $dados["tipoPagamento"] == "PIX" ? "selected" : "" ?>>PIX</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="statusPagamento" class="form-label">Status Pagamento</label>
                            <select id="statusPagamento" name="statusPagamento"
                                class="form-select bg-dark text-light border-secondary"
                                required>

                                <option value="Não informado" <?= $dados["statusPagamento"] == "Não informado" ? "selected" : "" ?>>Selecione</option>
                                <option value="Pago" <?= $dados["statusPagamento"] == "Pago" ? "selected" : "" ?>>Pago</option>
                                <option value="Pendente" <?= $dados["statusPagamento"] == "Pendente" ? "selected" : "" ?>>Pendente</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="statusServico" class="form-label">Status do Serviço</label>
                        <select id="statusServico" name="statusServico"
                            class="form-select bg-dark text-light border-secondary"
                            required>
                            <option value="Não informado" <?= $dados["statusServico"] == "Não informado" ? "selected" : "" ?>>Selecione</option>
                            <option value="Em Análise" <?= $dados["statusServico"] == "Em Análise" ? "selected" : "" ?>>Em Análise</option>
                            <option value="Em Andamento" <?= $dados["statusServico"] == "Em Andamento" ? "selected" : "" ?>>Em Andamento</option>
                            <option value="Não realizado" <?= $dados["statusServico"] == "Não realizado" ? "selected" : "" ?>>Não realizado</option>
                            <option value="Concluído" <?= $dados["statusServico"] == "Concluído" ? "selected" : "" ?>>Concluído</option>
                        </select>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location.href='index.php?menuop=ordemservico';">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Ordem de Serviço</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6 d-flex flex-column align-items-center text-center">
            <img src="img/edit-tasks.png" alt="Editar Ordem de Serviço"
                class="img-fluid mb-3" style="max-width: 100%; height: auto; max-height: 400px;">
            <h2 class="text-light">Edição de Ordem de Serviço</h2>
            <p class="text-white-50">Atualize os dados da Ordem de Serviço no formulário ao lado e clique em "Atualizar" para salvar as mudanças.</p>
        </div>
    </div>
</div>