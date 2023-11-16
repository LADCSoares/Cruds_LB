<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM celulares WHERE id=$id";
    $result = $conn->query($sql);

    if ($result) {
        echo "Celular excluído com sucesso!";
    } else {
        echo "Erro ao excluir o celular: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
