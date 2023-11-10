<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT id, nome, email FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
