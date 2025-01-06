<?php

$senha = "123456";
$senhaCriptografada = hash('sha256',$senha);

var_dump($senha);
echo "<br>";
var_dump($senhaCriptografada);
?>