

<?php

if (!isset($conexao)) {
    die("<div class='container my-5'>
            <div class='alert alert-danger text-center' role='alert'>
                <strong>Erro!</strong> Conexão com o banco de dados não encontrada.
            </div>
        </div>");
}

$idCliente = mysqli_real_escape_string($conexao, $_POST["idCliente"] ?? '');
$nomeCliente = mysqli_real_escape_string($conexao, $_POST["nomeCliente"] ?? '');
$emailCliente = mysqli_real_escape_string($conexao, $_POST["emailCliente"] ?? '');
$telefoneCliente = mysqli_real_escape_string($conexao, $_POST["telefoneCliente"] ?? '');
$sexoCliente = mysqli_real_escape_string($conexao, $_POST["sexoCliente"] ?? '');
$dataNascCliente = mysqli_real_escape_string($conexao, $_POST["dataNascCliente"] ?? '');

if (empty($idCliente) || empty($nomeCliente) || empty($emailCliente) || empty($telefoneCliente) || empty($sexoCliente) || empty($dataNascCliente)) {
    echo "
    <div class='container my-5'>
        <div class='alert alert-danger text-center' role='alert'>
            <strong>Erro!</strong> Todos os campos são obrigatórios. Por favor, preencha o formulário corretamente.
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-danger'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>
    </div>";
    exit();
}

$sql = "UPDATE tbcliente SET
        nomeCliente = '{$nomeCliente}',
        emailCliente = '{$emailCliente}',
        telefoneCliente = '{$telefoneCliente}',
        sexoCliente = '{$sexoCliente}',
        dataNascCliente = '{$dataNascCliente}'
        WHERE idCliente = '{$idCliente}'";

if (mysqli_query($conexao, $sql)) {
    echo "
    <div class='container my-5'>
        <div class='text-center'>
            <img src='img/sucesso.png' alt='Sucesso' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 300px;'>
        </div>

        <div class='text-center'>
        <h3>Sucesso!</h3>
        <p>O registro foi atualizado com sucesso.</p>
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-success'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>
    </div>";
} else {
    echo "
    <div class='container my-5'>
        <div class='alert alert-danger text-center' role='alert'>
            <strong>Erro!</strong> Não foi possível atualizar o registro: " . htmlspecialchars(mysqli_error($conexao)) . "
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-danger'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>
    </div>";
}
?>
