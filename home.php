
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <?php
    include("conexao.php");

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    ?>

    <h2>Bem-vindo à Página Inicial</h2>
    <a href="logout.php">Logout</a>

    <!-- Adicione seu código de CRUD de usuários aqui usando Ajax -->
</body>

</html>
