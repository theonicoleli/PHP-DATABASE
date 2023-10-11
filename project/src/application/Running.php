<?php
include(__DIR__ . '/../entities/Pessoa.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $rendimento = $_POST["rendimento"];
    $dependentes = $_POST["dependentes"];
    $pensaoAlimenticia = $_POST["pensaoAlimenticia"];

    try {
        // Inclua o arquivo da classe Pessoa

        // Create a new Pessoa object
        $pessoa = new Pessoa($nome, $email, $rendimento, $dependentes, $pensaoAlimenticia);

        // Add the Pessoa to the database
        $pessoa->addPessoa();

        // Call the function to display the list after adding a person
        $pessoa->verLista();
    } catch (\Exception $e) {
        // Handle any exceptions, e.g., display an error message
        echo "Error: " . $e->getMessage();
    }
}
?>
