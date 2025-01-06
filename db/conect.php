<?php
include("config.php");
$conexao  = mysqli_connect(SERVIDOR,USUARIO,SENHA,DATA) or die("Erro na  conexão com o servidor!".mysqli_connect_error());
?>