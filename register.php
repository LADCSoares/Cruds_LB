<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lilita+One|Roboto+Slab">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <title>Registro</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
              body{
                background-color: #3c8782;
             }
             .contorno{
              background-color:#06acbe;
              }
              .contorno2{
              background-color:#ffffff;
              }
              .contorno3{
                background-color: rgb(8,83,148);
              }
              .imagem2{
                height:200px;
                float: center;
              }
              .topicos{
		            font-family: "Roboto", sans-serif;
		            font-size: 17px;
		            font-weight: 800;
                margin-left: 43px;;
	            }
              .topico5{
		            font-family: "Roboto", sans-serif;
		            font-size: 17px;
		            font-weight: 800;

	            }
                .topico7{
		            font-family: "Roboto", sans-serif;
		            font-weight: 800;
	            }
            .logar{
              font-weight: bold;
            }
     </style> 
</head>

<body>
    <?php
    include("conexao.php");

    session_start();

    // if (isset($_SESSION['user_id'])) {
    //     header("Location: home.php");
    //     exit();
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        $result = $conn->query($sql);

        if ($result) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o usuário: " . $conn->error;
        }
    }
    ?>


    <div class="row">
    <br><br>
    <div class="container col s6 offset-s3 center-align contorno">
      <br><br>
    <div class="container col s10 offset-s1 center-align contorno2">
      <br><br>
    <h3 class="center-aling topico7">Registro</h3>
    <br><br>
    <div class="col s10 offset-s1 left-align">
    <form method="post">

                     <p class="topicos ">Nome:</p>
					<div class="input-field">
						<i class="material-icons prefix"></i>
						<label for="nome"> </label>
						<input type="text" name="nome" required>
					</div>
                    <p class="topicos ">E-mail:</p>
					<div class="input-field">
						<i class="material-icons prefix"></i>
						<label for="email"> </label>
						<input type="email" name="email" required>
					</div>
					<p class="topicos">Senha:</p>
          			<div class="input-field">
						<i class="material-icons prefix"></i>
						<label for="sena"></label>
						<input type="password" name="senha" required>
					</div>

          <div class="col s10 offset-s6">
          <p>Já tem uma conta? <a class="" href="index.php"><span class=" topicos5 logar">Faça login</span></a></p>
          </div>
        
          <br> <br>
			  		<p class="center-align">
						<button class="waves-effect waves-light btn-large  white-text cyan accent-3 logar" type="submit" name="login"> Registrar </button>
					  </p>
          <br>

			  </form>
    </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  </div>
  <br><br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
              
        <script>

        </script>
</body>

</html>
