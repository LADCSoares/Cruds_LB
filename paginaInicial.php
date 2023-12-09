<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
    <link rel="stylesheet" href="css/estilo.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Baixa e usa CSS na CDN-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->

    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
      .centro{
        margin-left: 900px;
      }
  
      .logo1{
        margin-left: 200px;
      }
      .logo2{
        margin-right: 100px;
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
            .cont2{
		font-family: "Lilita One", sans-serif;
		font-size: 50px;
	}
    </style>

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

<div class="navbar-fixed">
      <nav>
        <div class="nav-wrapper cyan accent-3 font2">
          <a href="paginaInicial.php" class="brand-logo logo1">DeTudo.com</a>
          <ul class="right hide-on-med-and-down logo2">
            <li><a href="home.php">Usuários</a></li>
            <li><a href="crudMac.php">Itens</a></li>
            <li><a href="cadastrarCelular.php">Celulares</a></li>
            <li><a class="black-text" href="logout.php"><i class="material-icons">power_settings_new</i></a></li>
          </ul>
        </div>
      </nav>
    </div>
  
    <br><br>

    <div class="row">
    <div class="col s10 offset-s2">
    <div class="container z-depth-3 col s10 offset-s0 yellow darken-1">
    <h4 class="center-align white-text topico7"> Bem-vindo à Página Inicial! </h4>
    </div>
    <br><br><br><br><br><br><br><br><br>
    <div class="row">

<div class="col s4 ">
<div class="container z-depth-3 col s3 offset-s1 cont2 amber lighten-1 ">
  <a class=" black-text " href="home.php"> Usuários </a>
</div>
</div>
<div class="col s3 ">
<div class="container z-depth-3 col s3 offset-s0 cont2 amber lighten-1 ">
  <a class=" black-text " href="consultarPeda.php"> Itens </a>
</div>
</div>
<div class="col s3 ">
<div class="container z-depth-3 col s3 offset-s0 cont2 amber lighten-1 ">
  <a class=" black-text " href="cadastrarCelular.php"> Celulares </a>
</div>
</div>

</div>
    </div>
    </div>

   



    <script>
      
    </script>
     <script type="text/javascript" src="js/materialize.js"></script>
</body>

</html>