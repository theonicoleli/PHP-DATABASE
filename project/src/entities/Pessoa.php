<?php
class Pessoa {
    private $nome;
    private $email;
    private $rendimento;
    private $dependentes;
    private $pensaoAlimenticia;

    public function __construct($nome, $email, $rendimento, $dependentes, $pensaoAlimenticia) {
        $inputs = [
            'nome' => $nome,
            'email' => $email,
            'rendimento' => $rendimento,
            'dependentes' => $dependentes,
            'pensaoAlimenticia' => $pensaoAlimenticia,
        ];
    
        foreach ($inputs as $property => $value) {
            $this->$property = $value ?? throw new \Exception("Coloque um valor correto para $property.");
        }
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRendimento() {
        return $this->rendimento;
    }

    public function getDependentes() {
        return $this->dependentes;
    }

    public function getPensaoAlimenticia() {
        return $this->pensaoAlimenticia;
    }

    public function accessingDataBase() {
        
        $serverName = "DESKTOP-98L1OCM"; 
        $userName = "estudos"; 
        $password = "estudos1234"; 
        $database = "FORMSPHP";       

        $conn = new mysqli($serverName, $userName, $password, $database);

        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function addPessoa() {
        try {
            $conn = $this->accessingDataBase();

            // Prepare and bind the SQL statement
            $sql = "INSERT INTO Pessoa (Nome, Email, Rendimento, Dependentes, PensaoAlimenticia) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdii", $this->nome, $this->email, $this->rendimento, $this->dependentes, $this->pensaoAlimenticia);

            // Execute the statement
            $stmt->execute();

            echo "Pessoa adicionada com sucesso.";

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        } catch (\Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function verLista() {
        try {
            $conn = $this->accessingDataBase();
    
            // Define the SQL query to retrieve all records from the "Pessoa" table
            $sql = "SELECT * FROM Pessoa";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Rendimento</th><th>Dependentes</th><th>PensaoAlimenticia</th></tr>";
    
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID_PESSOA"] . "</td>";
                    echo "<td>" . $row["Nome"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Rendimento"] . "</td>";
                    echo "<td>" . $row["Dependentes"] . "</td>";
                    echo "<td>" . $row["PensaoAlimenticia"] . "</td>";
                    echo "</tr>";
                }
    
                echo "</table>";
            } else {
                echo "Nenhum registro encontrado na tabela Pessoa.";
            }
    
            // Close the connection
            $conn->close();
        } catch (\Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
