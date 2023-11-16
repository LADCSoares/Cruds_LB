<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $preco = $_POST["preco"];

    $sql = "UPDATE celulares SET marca='$marca', modelo='$modelo', preco='$preco' WHERE id=$id";
    $result = $conn->query($sql);

    if ($result) {
        echo "Celular editado com sucesso!";
    } else {
        echo "Erro ao editar o celular: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
