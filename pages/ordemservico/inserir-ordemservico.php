<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $camposObrigatorios = ["idCliente", "servico", "descricaoServico", "dataEntradaServico", "valorServico", "tipoPagamento", "statusPagamento", "statusServico"];
    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            die("Erro: Todos os campos obrigatórios devem ser preenchidos. Campo ausente: {$campo}");
        }
    }
    $idCliente = (int) $_POST["idCliente"];
    $servico = mysqli_real_escape_string($conexao, $_POST["servico"]);
    $descricaoServico = mysqli_real_escape_string($conexao, $_POST["descricaoServico"]);
    $dataEntradaServico = mysqli_real_escape_string($conexao, $_POST["dataEntradaServico"]);

    $dataSaidaServico = !empty($_POST["dataSaidaServico"]) ? "'" . mysqli_real_escape_string($conexao, $_POST["dataSaidaServico"]) . "'" : "NULL";

    $valorServico = (float) $_POST["valorServico"];
    $tipoPagamento = mysqli_real_escape_string($conexao, $_POST["tipoPagamento"]);
    $statusPagamento = mysqli_real_escape_string($conexao,$_POST["statusPagamento"]);
    $statusServico = mysqli_real_escape_string($conexao, $_POST["statusServico"]);

    $sql = "INSERT INTO ordemservico (
                idCliente,
                produtoServicoOS,
                descricaoOS,
                dataEntrada,
                dataSaida,
                valorServico,
                tipoPagamento,
                statusPagamento,
                statusOS
            ) VALUES (
                {$idCliente},
                '{$servico}',
                '{$descricaoServico}',
                '{$dataEntradaServico}',
                {$dataSaidaServico},
                {$valorServico},
                '{$tipoPagamento}',
                '{$statusPagamento}',
                '{$statusServico}'
            )";

    if (mysqli_query($conexao, $sql)) {
        echo "
        <div class='container my-5'>
            <div class='text-center'>
                <img src='img/sucesso.png' alt='Sucesso' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 300px;'>
            </div>

            <div class='text-center'>
                <h3>Sucesso!</h3>
                <p>O registro foi cadastrado com sucesso.</p>
            </div>
        
            <div class='text-center mt-4'>
                <a href='index.php?menuop=detalhe-cliente&idCliente={$idCliente}' class='btn btn-outline-success'>
                    <i class='bi bi-arrow-left'></i> Voltar para Ordem de Serviço
                </a>
            </div>
        </div>";
    } else {
        echo "
        <div class='container my-5'>
            <div class='alert alert-danger text-center' role='alert'>
                <strong>Erro!</strong> Não foi possível cadastrar a Ordem de Serviço: " . mysqli_error($conexao) . "
            </div>
            <div class='text-center mt-4'>
                <a href='index.php?menuop=detalhe-cliente&idCliente={$idCliente}' class='btn btn-outline-danger'>
                    <i class='bi bi-arrow-left'></i> Voltar para Ordem de Serviço
                </a>
            </div>
        </div>";
    }
} else {
    die("Método inválido.");
}
?>
