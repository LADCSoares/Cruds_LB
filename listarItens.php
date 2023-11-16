<?php
include_once "conectar.php";
$conexao = conectar();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM itens WHERE id = $id";
} else {
    $sql = "SELECT * FROM itens";
}

$resultado = mysqli_query($conexao, $sql);

if ($resultado == TRUE) {
    $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    echo json_encode($itens);
} else {
    die("Erro ao buscar os dados dos itens." . mysqli_errno($conexao) . ":" . mysqli_error($conexao));
}
?>

