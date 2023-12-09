<?php
///echo json_encode("Salvou");

include "conectar.php";
$conexao = conectar();
//pega os dados cru da entrada do PHP 
$item = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "INSERT INTO itens (nome, descricao, preco) VALUES ('$item->nome', '$item->descricao', '$item->preco')";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado == TRUE) {
        $item->id = mysqli_insert_id($conexao);
        //Converte o objeto pessoa em uma string no formato JSON
        echo json_encode($item);
    } else {
        die("Erro ao inserir o item no banco de dada " .
            mysqli_error($conexao) . ":" . mysqli_error($conexao));
    }
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") { //EDITAR
    $sql = "UPDATE itens SET nome='$item->nome', descricao='$item->descricao', preco='$item->preco'' WHERE id=$item->id ;
";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado == TRUE) {
        echo json_encode($item);
    } else {
        die("Erro ao inserir o item no banco de dados" . mysqli_error($conexao));
    }
}

?>
