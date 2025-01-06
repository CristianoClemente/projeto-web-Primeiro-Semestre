<?php
// Incluindo a conexão com o banco de dados
include("./db/conect.php");
$msg_error = "";

if (isset($_POST["email"]) && isset($_POST["senha"])) {
    $email = mysqli_escape_string($conexao, $_POST["email"]);
    $senha = $_POST["senha"];

    // Consulta SQL para verificar se o e-mail e senha informados existem no banco de dados
    $sql = "SELECT idUser, nome, email, senha FROM users WHERE email= '{$email}'";
    $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao));
    $dados = mysqli_fetch_assoc($rs);

    // Verifica se o e-mail informado existe no banco de dados
    if ($dados) {
        // Verifica se a senha informada é igual a senha criptografada no banco de dados
        if (hash('sha256', $senha) === $dados["senha"]) {
            // Inicia a sessão 
            session_start();
            $_SESSION["idUser"] = $dados["idUser"];
            $_SESSION["nome"] = $dados["nome"];
            $_SESSION["email"] = $dados["email"];
            $_SESSION["senha"] = $dados["senha"];

            // Redireciona para a página inicial
            header("Location: index.php");
        } else {
            $msg_error = "<p class='text-danger'>E-mail não cadastrado ou senha inválida.</p>";
        }
    } else {
        $msg_error = "<p class='text-danger'>E-mail não cadastrado ou senha inválida.</p>";
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
    <title>Login - Ordem de Serviço</title>
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
                        <h3 class="text-light mt-3">Login</h3>
                        <p class="text-white-50">Acesse o sistema com suas credenciais</p>
                    </header>
                    <form action="login.php" method="post">
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
                            <button type="submit" class="btn btn-success btn-lg">Login</button>
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="window.location.href='cadastro.php'">Cadastre-se</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 d-flex flex-column align-items-center text-center">
                <img src="img/Secure login-pana.png" alt="Login no Sistema" class="img-fluid mb-3" style="max-width: 100%; height: auto; max-height: 350px;">
                <h3 class="text-light">Bem-vindo!</h3>
                <p class="text-white-50">Simplifique o gerenciamento de Ordens de Serviço.<br> Preencha os campos ao lado para acessar todas as <br>ferramentas que você precisa.</p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>