<?php
include "conexao.php";
$conexao = conectar();

$item = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "INSERT INTO itens (nome, descricao, preco) VALUES ('$item->nome', '$item->descricao', '$item->preco')";
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $sql = "UPDATE itens SET nome='$item->nome', descricao='$item->descricao', preco='$item->preco' WHERE id=$item->id";
}

$resultado = mysqli_query($conexao, $sql);

if ($resultado == TRUE) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $item->id = mysqli_insert_id($conexao);
    }
    echo json_encode($item);
} else {
    die("Erro ao salvar o item no banco de dados " . mysqli_error($conexao) . ":" . mysqli_error($conexao));
}
?>
