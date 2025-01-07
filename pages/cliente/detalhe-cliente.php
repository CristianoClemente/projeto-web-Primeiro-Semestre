<?php
// Captura o ID do cliente na URL
$idCliente = isset($_GET['idCliente']) ? (int)$_GET['idCliente'] : 0;

// Consulta para buscar os dados do cliente
$sql_cliente = "SELECT * FROM tbcliente WHERE idCliente = $idCliente";
$result_cliente = mysqli_query($conexao, $sql_cliente) or die("Erro ao buscar cliente: " . mysqli_error($conexao));
$cliente = mysqli_fetch_assoc($result_cliente);

if ($cliente) {
?>
    <div class="container my-5">
        <header class="text-start mb-4">
            <h1 class="text-light">Informações do Cliente</h1>
        </header>

        <div class="card bg-dark text-light mb-4">
            <div class="card-body">
                <h5 class="card-title">Nome: <?= htmlspecialchars($cliente['nomeCliente']) ?></h5>
                <p class="card-text">Email: <?= htmlspecialchars($cliente['emailCliente']) ?></p>
                <p class="card-text">Telefone: <?= htmlspecialchars($cliente['telefoneCliente']) ?></p>
            </div>
        </div>

        </header>
        <?php
        $sql_ordens = "SELECT 
            os.idOrdemServico, 
            os.produtoServicoOS,
            os.descricaoOS,
            DATE_FORMAT(os.dataEntrada,'%d/%m/%Y') AS dataEntrada,
            DATE_FORMAT(os.dataSaida,'%d/%m/%Y') AS dataSaida,
            os.statusOS,
            FORMAT(os.valorServico, 2, 'pt_BR') AS valorServico,
            statusPagamento
        FROM ordemservico os
        WHERE os.idCliente = $idCliente
        ORDER BY os.dataEntrada DESC";

        $result_ordens = mysqli_query($conexao, $sql_ordens) or die("Erro ao buscar ordens de serviço: " . mysqli_error($conexao));

        if (mysqli_num_rows($result_ordens) > 0) {
        ?>
            <header class="text-start mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h2 class="text-light">Ordens de Serviço</h2>
                    <a class="btn btn-success" href="index.php?menuop=cad-ordemservico&idCliente=<?= $idCliente ?>" role="button" style="min-width: 150px;">
                        <i class="bi bi-plus-circle"></i> Nova Ordem de Serviço
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover align-middle" style="font-size: 0.9rem;">
                        <thead>
                            <tr class="text-success text-center">
                                <th scope="col">ID</th>
                                <th scope="col">Produto/Serviço</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Saída</th>
                                <th scope="col">Status</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Pagamento</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ordem = mysqli_fetch_assoc($result_ordens)) {
                            ?>
                                <tr class="text-center">
                                    <td><?= $ordem['idOrdemServico'] ?></td>
                                    <td><?= htmlspecialchars($ordem['produtoServicoOS']) ?></td>
                                    <td><?= htmlspecialchars($ordem['descricaoOS']) ?></td>
                                    <td><?= $ordem['dataEntrada'] ?></td>
                                    <td><?= $ordem['dataSaida'] ?></td>
                                    <td>
                                        <?php if ($ordem["statusOS"] === "Concluído") { ?>
                                            <span class="text-success">Concluído</span>
                                        <?php } elseif ($ordem["statusOS"] === "Em Análise") { ?>
                                            <span class="text-warning">Em Análise</span>
                                        <?php } elseif ($ordem["statusOS"] === "Em Andamento") { ?>
                                            <span class="text-primary">Em Andamento</span>
                                        <?php } elseif ($ordem["statusOS"] === "Não realizado") { ?>
                                            <span class="text-danger">Não realizado</span>
                                        <?php } else { ?>
                                            <span>Não informado</span>
                                        <?php } ?>
                                    </td>
                                    <td>R$ <?= $ordem['valorServico'] ?></td>
                                    <td>
                                        <?php if ($ordem["statusPagamento"] === "Pago") { ?>
                                            <span class="text-success">Pago</span>
                                        <?php } else { ?>
                                            <span class="text-warning">Pendente</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="index.php?menuop=editar-ordemservico&idOrdemServico=<?= $ordem['idOrdemServico'] ?>" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
        } else {
            ?>
                <div class='text-center'>
                    <h3>Ops! Nenhuma ordem de serviço encontrada.</h3>
                    <p>Adicione uma nova ordem de serviço para este cliente.</p>
                    <a href="index.php?menuop=cad-ordemservico&idCliente=<?= $idCliente ?>" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle"></i> Nova Ordem de Serviço
                    </a>
                </div>
            <?php
        }
            ?>
    </div>
<?php
} else {
?>
    <div class='container my-5'>
        <div class='text-center'>
            <h3>Cliente não encontrado.</h3>
            <p>Verifique se o ID do cliente está correto.</p>
        </div>
    </div>
<?php
}
?>
