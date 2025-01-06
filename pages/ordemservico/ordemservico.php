<div class="container my-5">
    <?php
    $qtd = 10;
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $init = ($qtd * $page) - $qtd;

    $txt_pesquisa = isset($_POST["txt_pesquisar"]) ? mysqli_real_escape_string($conexao, $_POST["txt_pesquisar"]) : "";

    $where_clause = "1";
    if (!empty($txt_pesquisa)) {
        if (is_numeric($txt_pesquisa)) {
            $where_clause = "idOrdemServico = '{$txt_pesquisa}'";
        } else {
            $where_clause = "produtoServicoOS LIKE '%{$txt_pesquisa}%'";
        }
    }

    $sql_count = "SELECT COUNT(*) AS total FROM ordemservico WHERE $where_clause";
    $result_count = mysqli_query($conexao, $sql_count) or die("Erro ao contar registros: " . mysqli_error($conexao));
    $row_count = mysqli_fetch_assoc($result_count);
    $numTotal = $row_count['total'];
    $totalPage = ceil($numTotal / $qtd);

    $sql = "SELECT 
        os.idOrdemServico, 
        os.produtoServicoOS,
        os.descricaoOS,
        DATE_FORMAT(os.dataEntrada,'%d/%m/%Y') AS dataEntrada,
        DATE_FORMAT(os.dataSaida,'%d/%m/%Y') AS dataSaida,
        os.idCliente,
        c.nomeCliente,
        os.statusOS,
        FORMAT(os.valorServico, 2, 'pt_BR') AS valorServico,
        os.tipoPagamento,
        os.statusPagamento
    FROM ordemservico os
    LEFT JOIN tbcliente c ON os.idCliente = c.idCliente
    WHERE $where_clause
    ORDER BY os.produtoServicoOS ASC
    LIMIT $init, $qtd";

    $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conexao));

    if (mysqli_num_rows($rs) > 0) {
    ?>

        <header class="text-start mb-4">
            <h1 class="text-light">Ordens de Serviço</h1>
            <p class="text-white-50">Altere as informações abaixo para atualizar a Ordem de Serviço</p>
        </header>
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <form action="index.php?menuop=ordemservico" method="post" class="d-flex align-items-center flex-grow-1">
                <input
                    type="search"
                    name="txt_pesquisar"
                    class="form-control bg-dark text-light me-2"
                    placeholder="Pesquisar ordens de serviço"
                    style="max-width: 300px; border: 1px solid #6c757d;"
                    value="<?= htmlspecialchars($txt_pesquisa) ?>">
                <button type="submit" class="btn btn-outline-success">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-dark table-hover align-middle" style="font-size: 0.9rem;">
                <thead>
                    <tr class="text-success text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Produto/Serviço</th>
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
                    while ($dados = mysqli_fetch_assoc($rs)) {
                    ?>
                        <tr class="text-center" style="padding: 0.2rem;">
                            <td><?= $dados["idOrdemServico"] ?></td>
                            <td><?= $dados["nomeCliente"] ?></td>
                            <td><?= $dados["produtoServicoOS"] ?></td>
                            <td><?= $dados["dataEntrada"] ?></td>
                            <td><?= $dados["dataSaida"] ?></td>
                            <td><?= $dados["statusOS"] ?></td>
                            <td>R$ <?= $dados["valorServico"] ?></td>
                            <td><?= $dados["statusPagamento"] ?></td>
                            <td>
                                <a href="index.php?menuop=editar-ordemservico&idOrdemServico=<?= $dados["idOrdemServico"] ?>" class="btn btn-primary btn-sm">
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

        <nav class="d-flex justify-content-between align-items-center mt-4 p-3 bg-dark rounded" style="border: 1px solid #444;">
            <div class="text-light">
                Total de registros: <?= $numTotal ?>
            </div>
            <ul class="pagination m-0">
                <?php
                echo "<li class='page-item" . ($page <= 1 ? " disabled" : "") . "'>
                    <a class='page-link border-0 px-3 py-1 " . ($page <= 1 ? "bg-dark text-muted" : "bg-dark text-success hover-success") . "' href='" . ($page > 1 ? "?menuop=ordemservico&page=" . ($page - 1) : "#") . "' tabindex='-1'>Anterior</a>
                </li>";

                for ($i = 1; $i <= $totalPage; $i++) {
                    if ($i >= ($page - 4) && $i <= ($page + 4)) {
                        echo "<li class='page-item" . ($i == $page ? " active" : "") . "'>
                            <a class='page-link px-3 py-1 border-0 " . ($i == $page ? "bg-success text-white" : "bg-dark text-success hover-success") . "' href='?menuop=ordemservico&page=$i'>$i</a>
                        </li>";
                    }
                }

                echo "<li class='page-item" . ($page >= $totalPage ? " disabled" : "") . "'>
                    <a class='page-link border-0 px-3 py-1 " . ($page >= $totalPage ? "bg-dark text-muted" : "bg-dark text-success hover-success") . "' href='" . ($page < $totalPage ? "?menuop=ordemservico&page=" . ($page + 1) : "#") . "'>Próximo</a>
                </li>";
                ?>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <div class='container my-5'>
            <div class='text-center'>
                <img src='img/empty.png' alt='Nenhuma ordem encontrada' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 300px;'>
            </div>

            <div class='text-center'>
                <h3>Ops! Nenhuma ordem encontrada.</h3>
                <p>Adicione uma nova ordem de serviço.</p>
                <a href='index.php?menuop=ordemservico' class='btn btn-outline-light mt-3'>Voltar à lista</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>