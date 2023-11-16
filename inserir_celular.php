<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $preco = $_POST["preco"];

    $sql = "INSERT INTO celulares (marca, modelo, preco) VALUES ('$marca', '$modelo', '$preco')";
    $result = $conn->query($sql);

    if ($result) {
        echo "Celular inserido com sucesso!";
    } else {
        echo "Erro ao inserir o celular: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
