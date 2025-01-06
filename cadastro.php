<?php
// Incluindo a conexão com o banco de dados
include("./db/conect.php");
$msg_error = "";

if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
    $nome = mysqli_escape_string($conexao, $_POST["nome"]);
    $email = mysqli_escape_string($conexao, $_POST["email"]);
    $senha = hash('sha256', $_POST["senha"]);

    $sql_check = "SELECT idUser FROM users WHERE email = '{$email}'";
    $rs_check = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($rs_check) > 0) {
        $msg_error = "<p class='text-danger'>O e-mail informado já está cadastrado. Por favor, utilize outro e-mail.</p>";
    } else {
        $sql = "INSERT INTO users (nome, email, senha) VALUES ('{$nome}', '{$email}', '{$senha}')";
        if (mysqli_query($conexao, $sql)) {
            header("Location: login.php?success=1");
        } else {
            $msg_error = "<p class='text-danger'>Erro ao cadastrar. Por favor, tente novamente.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.0">
    <title>Cadastro - Ordem de Serviço</title>
</head>

<body class="bg-dark text-light">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-dark text-light shadow-lg p-4 rounded">
                    <header class="text-start mb-2">
                        <a class="navbar-brand d-flex align-items-center" href="#">
                            <img src="img/logo.png" alt="Logo" width="200"  class="me-1">
                        </a>
                        <h3 class="text-light mt-3">Cadastro</h3>
                        <p class="text-white-50">Preencha os campos abaixo para criar sua conta</p>
                    </header>
                    <form action="cadastro.php" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control bg-dark text-light border-secondary" placeholder="Digite seu nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control bg-dark text-light border-secondary" placeholder="Digite seu e-mail" required>
                        </div>
                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control bg-dark text-light border-secondary" placeholder="Digite sua senha" required>
                        </div>
                        <?php echo $msg_error; ?>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="window.location.href='login.php'">Já tenho uma conta</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 d-flex m-6  flex-column align-items-center text-center">
                <img src="img/cadastrar.png" alt="Cadastro de Usuário" class="img-fluid mt-3" style="max-width: 100%; height: auto; max-height: 350px;">
                <h3 class="text-light">Bem-vindo!</h3>
                <p class="text-white-50">Cadastre-se para começar a gerenciar suas Ordens de Serviço com facilidade.<br> Preencha o formulário ao lado e aproveite nossas ferramentas.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
