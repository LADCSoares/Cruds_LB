<?php
include_once "conexao.php";
$conexao = conectar();

$id = $_GET['id'];

$sql = "DELETE FROM itens WHERE id=$id";
$resultado = mysqli_query($conexao, $sql);

if ($resultado == TRUE) {
    echo '{"id":"' . $id . '"}';
} else {
    die("Erro ao deletar o item." . mysqli_errno($conexao) . ":" . mysqli_error($conexao));
}
?>