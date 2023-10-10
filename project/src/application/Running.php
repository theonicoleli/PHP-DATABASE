<?php
include(__DIR__ . '/../entities/Pessoa.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $rendimento = $_POST["rendimento"];
    $dependentes = $_POST["dependentes"];
    $pensaoAlimenticia = $_POST["pensaoAlimenticia"];

    try {
        $pessoa = new Pessoa($nome, $email, $rendimento, $dependentes, $pensaoAlimenticia);

        $pessoa->addPessoa();

        $pessoa->verLista();
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
