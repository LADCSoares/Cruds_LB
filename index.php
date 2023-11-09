<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <?php
    include("conexao.php");

    session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: home.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica as credenciais
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location: home.php");
                exit();
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    }
    ?>

    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit">Login</button>
    </form>

    <p>Ainda não tem uma conta? <a href="register.php">Registre-se</a></p>
</body>

</html>
