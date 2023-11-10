<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
    $result = $conn->query($sql);

    if ($result) {
        echo "Usuário editado com sucesso!";
    } else {
        echo "Erro ao editar o usuário: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
