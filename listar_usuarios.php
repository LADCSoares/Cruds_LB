<?php
include("conexao.php");

// Busca todos os usuários no banco de dados
$sql = "SELECT id, nome, email FROM usuarios";
$result = $conn->query($sql);

$usuarios = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Retorna os usuários em formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

$conn->close();
?>
