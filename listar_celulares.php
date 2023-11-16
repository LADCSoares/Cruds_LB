<?php
include("conexao.php");

// Busca todos os celulares no banco de dados
$sql = "SELECT id, marca, modelo, preco FROM celulares";
$result = $conn->query($sql);

$celulares = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $celulares[] = $row;
    }
}

// Retorna os celulares em formato JSON
header('Content-Type: application/json');
echo json_encode($celulares);

$conn->close();
?>
