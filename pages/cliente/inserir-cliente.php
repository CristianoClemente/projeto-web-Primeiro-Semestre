<header class="text-center my-4">
    <h2 class="text-success">Inserir Cliente</h2>
</header>

<?php
$nomeCliente = mysqli_real_escape_string($conexao, $_POST["nomeCliente"]);
$emailCliente = mysqli_real_escape_string($conexao, $_POST["emailCliente"]);
$telefoneCliente = mysqli_real_escape_string($conexao, $_POST["telefoneCliente"]);
$sexoCliente = mysqli_real_escape_string($conexao, $_POST["sexoCliente"]);
$dataNascCliente = mysqli_real_escape_string($conexao, $_POST["dataNascCliente"]);

$sql = "INSERT INTO tbcliente (
            nomeCliente,
            emailCliente,
            telefoneCliente,
            sexoCliente,
            dataNascCliente)
        VALUES (
            '{$nomeCliente}',
            '{$emailCliente}',
            '{$telefoneCliente}',
            '{$sexoCliente}',
            '{$dataNascCliente}'
        )";

if (mysqli_query($conexao, $sql)) {
    echo "
    <div class='container my-5'>
        <div class='text-center'>
            <img src='img/sucesso.png' alt='Sucesso' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 300px;'>
        </div>

        <div class='text-center'>
        <h3>Sucesso!</h3>
        <p>O registro foi Cadastrado com sucesso.</p>
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
            <strong>Erro!</strong> Não foi possível cadastrar o Cliente: " . mysqli_error($conexao) . "
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-danger'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>
    </div>";
}
?>