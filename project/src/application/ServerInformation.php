<?php
include(__DIR__ . '/../entities/Pessoa.php');

function getLista() {
    $pessoa = new Pessoa();
    $resultado = $pessoa->verLista();

    echo $resultado;
}

getLista();
?>
