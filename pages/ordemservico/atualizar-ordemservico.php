<?php

if (!isset($conexao)) {
    die("<div class='container my-5'>
            <div class='alert alert-danger text-center' role='alert'>
                <strong>Erro!</strong> Conexão com o banco de dados não encontrada.
            </div>
        </div>");
}

// Capturar o ID da Ordem de Serviço
$idOrdemServico = mysqli_real_escape_string($conexao, $_POST["idOrdemServico"] ?? '');
if (empty($idOrdemServico)) {
    die("<div class='container my-5'>
            <div class='alert alert-danger text-center' role='alert'>
                <strong>Erro!</strong> ID da Ordem de Serviço não fornecido.
            </div>
        </div>");
}

$camposAtualizar = [];

$idCliente = (int) $_POST["idCliente"];
if (!empty($_POST["servico"])) {
    $servico = mysqli_real_escape_string($conexao, $_POST["servico"]);
    $camposAtualizar[] = "produtoServicoOS = '{$servico}'";
}

if (!empty($_POST["descricaoServico"])) {
    $descricaoServico = mysqli_real_escape_string($conexao, $_POST["descricaoServico"]);
    $camposAtualizar[] = "descricaoOS = '{$descricaoServico}'";
}

if (!empty($_POST["dataEntradaServico"])) {
    $dataEntradaServico = mysqli_real_escape_string($conexao, $_POST["dataEntradaServico"]);
    $camposAtualizar[] = "dataEntrada = '{$dataEntradaServico}'";
}

if (isset($_POST["dataSaidaServico"])) {
    $dataSaidaServico = empty($_POST["dataSaidaServico"]) ? "NULL" : "'" . mysqli_real_escape_string($conexao, $_POST["dataSaidaServico"]) . "'";
    $camposAtualizar[] = "dataSaida = {$dataSaidaServico}";
}

if (!empty($_POST["valorServico"])) {
    $valorServico = mysqli_real_escape_string($conexao, $_POST["valorServico"]);
    $camposAtualizar[] = "valorServico = '{$valorServico}'";
}

if (!empty($_POST["tipoPagamento"])) {
    $tipoPagamento = mysqli_real_escape_string($conexao, $_POST["tipoPagamento"]);
    $camposAtualizar[] = "tipoPagamento = '{$tipoPagamento}'";
}

if (!empty($_POST["statusPagamento"])) {
    $statusPagamento = mysqli_real_escape_string($conexao, $_POST["statusPagamento"]);
    $camposAtualizar[] = "statusPagamento = '{$statusPagamento}'";
}

if (!empty($_POST["statusServico"])) {
    $statusServico = mysqli_real_escape_string($conexao, $_POST["statusServico"]);
    $camposAtualizar[] = "statusOS = '{$statusServico}'";
}

if (empty($camposAtualizar)) {
    die("<div class='container my-5'>
            <div class='alert alert-danger text-center' role='alert'>
                <strong>Erro!</strong> Nenhuma alteração foi feita. Por favor, preencha ao menos um campo.
            </div>
            <div class='text-center mt-4'>
                <a href='index.php?menuop=editar-ordemservico&idOrdemServico={$idOrdemServico}' class='btn btn-outline-danger'>
                    <i class='bi bi-arrow-left'></i> Voltar para Edição
                </a>
            </div>
        </div>");
}

$sql = "UPDATE ordemservico SET " . implode(", ", $camposAtualizar) . " WHERE idOrdemServico = '{$idOrdemServico}'";

if (mysqli_query($conexao, $sql)) {
    echo "
    <div class='container my-5'>
        <div class='text-center'>
            <img src='img/sucesso.png' alt='Sucesso' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 300px;'>
        </div>

        <div class='text-center'>
            <h3>Sucesso!</h3>
            <p>A Ordem de Serviço foi atualizada com sucesso.</p>
        </div>
    
        <div class='text-center mt-4'>
            <a href='index.php?menuop=detalhe-cliente&idCliente={$idCliente}' class='btn btn-outline-success'>
                <i class='bi bi-arrow-left'></i> Voltar para Ordens de Serviço
            </a>
        </div>
    </div>";
} else {
    echo "
    <div class='container my-5'>
        <div class='alert alert-danger text-center' role='alert'>
            <strong>Erro!</strong> Não foi possível atualizar a Ordem de Serviço: " . htmlspecialchars(mysqli_error($conexao)) . "
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=detalhe-cliente&idCliente={$idCliente}' class='btn btn-outline-danger'>
                <i class='bi bi-arrow-left'></i> Voltar para Edição
            </a>
        </div>
    </div>";
}
