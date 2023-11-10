<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir o usuário: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
