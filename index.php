<?php
include("db/conect.php");
session_start();

if (isset($_SESSION["email"]) and isset($_SESSION["senha"])) {
    $idUser = $_SESSION["idUser"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"];
    $senha = $_SESSION["senha"];

    $sql = "SELECT idUser, nome, email, senha FROM users WHERE email= '{$email}'";
    $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao));
    $dados = mysqli_fetch_assoc($rs);
    $linha  = mysqli_num_rows($rs);

    if ($linha == 0) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema Agendamento</title>
</head>

<body class="bg-dark text-light">

    <header class="bg-dark shadow">
        <div class="container d-flex align-items-center justify-content-between">

            <a class="navbar-brand d-flex align-items-center me-auto" href="#">
                <img src="img/logo.png" alt="Logo" width="120" height="40" class="me-1">
            </a>

            <nav class="nav navbar navbar-expand-lg navbar-dark mx-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['menuop']) && $_GET['menuop'] === 'cliente' ? 'active text-success' : '' ?>" href="index.php?menuop=cliente">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['menuop']) && $_GET['menuop'] === 'ordemservico' ? 'active text-success' : '' ?>" href="index.php?menuop=ordemservico">Ordens de Serviço</a>
                    </li>
                </ul>
            </nav>

            <div class="d-flex align-items-center ms-auto">
                <span class="text-light me-3">Olá, <?= $_SESSION["nome"] ?? 'Usuário' ?></span>
                <form method="post" style="display: inline;">
                    <button type="submit" name="logout" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </header>


    <?php

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>




    <main class="container my-5">
        <?php
        $menuop = (isset($_GET["menuop"])) ? $_GET["menuop"] : "cliente";
        switch ($menuop) {

            case 'cliente':
                include("pages/cliente/cliente.php");
                break;
            case 'cad-cliente':
                include("pages/cliente/cad-cliente.php");
                break;
            case 'inserir-cliente':
                include("pages/cliente/inserir-cliente.php");
                break;
            case 'editar-cliente':
                include("pages/cliente/editar-cliente.php");
                break;
            case 'atualizar-cliente':
                include("pages/cliente/atualizar-cliente.php");
                break;
            case 'excluir-cliente':
                include("pages/cliente/excluir-cliente.php");
                break;
            case 'detalhe-cliente':
                include("pages/cliente/detalhe-cliente.php");
                break;
            case 'cad-ordemservico':
                include("pages/ordemservico/cad-ordemservico.php");
                break;
            case 'ordemservico':
                include("pages/ordemservico/ordemservico.php");
                break;
            case 'inserir-ordemservico':
                include("pages/ordemservico/inserir-ordemservico.php");
                break;
            case 'editar-ordemservico':
                include("pages/ordemservico/editar-ordemservico.php");
                break;
            case 'atualizar-ordemservico':
                include("pages/ordemservico/atualizar-ordemservico.php");
                break;
            default:
                include("pages/ordemservico/ordemservico.php");
                break;
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>