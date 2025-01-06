<header class="text-center my-4">
    <h2 class="text-danger">Excluir Cliente</h2>
</header>

<?php
$idCliente = mysqli_real_escape_string($conexao, $_GET["idCliente"]);

$sql = "DELETE FROM tbcliente WHERE idCliente = '{$idCliente}'";

if (mysqli_query($conexao, $sql)) {
    echo "
  <div class='container my-5'>
        <div class='text-center'>
            <img src='img/delete.png' alt='Sucesso' class='img-fluid mb-3' style='max-width: 100%; height: auto; max-height: 200px;'>
        </div>

        <div class='text-center'>
        <h3>Sucesso!</h3>
        <p>O registro foi excluido com sucesso.</p>
        </div>
          <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-success'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>";
} else {
    echo "
    <div class='container my-5'>
        <div class='alert alert-danger text-center' role='alert'>
            <strong>Erro!</strong> Não foi possível excluir o Cliente: " . mysqli_error($conexao) . "
        </div>
        <div class='text-center mt-4'>
            <a href='index.php?menuop=cliente' class='btn btn-outline-danger'>
                <i class='bi bi-arrow-left'></i> Voltar para Clientes
            </a>
        </div>
    </div>";
}
?>