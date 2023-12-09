<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Usuário</title>
    <meta charset="utf-8">
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
    </div>
  
    <br><br>
    <div class="row">
    <div class="col s9 offset-s1 titulo">
       <h3>Listagem de Usuários</h3>
    </br>
    </div>
    </div>

    <div class="row">
    <article class="col s10 offset-s2 ">
    <table class="responsive-table striped ftabela" border="1">
        <thead class="titulo">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="listaUsuarios">
            <!-- A lista de usuários será carregada aqui usando Ajax -->
        </tbody>
    </table>
    </article>
</div>
<br> <br> <br>
    
    <div id="modalEditar" class="modal">
    <div class="modal-content">
        <h4 class="titulo">Editar Usuário</h4>
        <br>

        <form id="formEditar">

        <div class="input-field prefix.active">
        <input type="hidden" id="editId" name="id">
        </div>

        <div class="input-field prefix.active">
        <i class="material-icons prefix">perm_identity</i>
        <label for="editNome">Nome:</label>
        <input type="text" id="editNome" name="nome" required><br>
        </div>

        <div class="input-field prefix.active">
        <i class="material-icons prefix">mail_outline</i>
        <label for="editEmail">Email:</label>
        <input type="email" id="editEmail" name="email" required><br>
        </div>

        <button class="waves-effect waves-light btn  white-text cyan accent-3 logar" type="submit">Salvar</button>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
    </div>
</div>
<div id="modalExcluir" class="modal">
    <div class="modal-content">
        <h4>Excluir Usuário</h4>
        <p>Tem certeza que deseja excluir o usuário?</p>
        <input type="hidden" id="excluirId">
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat" onclick="confirmarExclusao()">Confirmar</a>
    </div>
</div>



    <script>
        $(document).ready(function () {
        // Função para carregar a lista de usuários usando Ajax
        function carregarUsuarios() {
            $.ajax({
                url: 'listar_usuarios.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var listaUsuarios = $('#listaUsuarios');
                    listaUsuarios.empty();

                    for (var i = 0; i < data.length; i++) {
                        listaUsuarios.append('<tr><td>' + data[i].id + '</td><td>' + data[i].nome + '</td><td>' + data[i].email + '</td>' +
                            '<td><button class="waves-effect waves-light btn white-text cyan accent-3 logar modal-trigger" href="#modalEditar" onclick="preencherFormEditar(' + data[i].id + ')">Editar</button>' + 
                            '<button class="waves-effect waves-light btn white-text cyan accent-3 logar modal-trigger" href="#modalExcluir" onclick="preencherFormExcluir(' + data[i].id + ')">Excluir</button></td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao carregar a lista de usuários: ' + error);
                }
            });
        }

        // Função para preencher o formulário de edição
        window.preencherFormEditar = function (id) {
            $.ajax({
                url: 'obter_usuario.php?id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#editId').val(data.id);
                    $('#editNome').val(data.nome);
                    $('#editEmail').val(data.email);
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao obter os dados do usuário: ' + error);
                }
            });
        }

        // Função para submeter o formulário de edição
        $('#formEditar').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: 'editar_usuario.php',
                type: 'POST',
                data: formData,
                success: function () {
                    carregarUsuarios(); // Atualiza a lista de usuários após a edição
                    $('#modalEditar').modal('close');
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao editar o usuário: ' + error);
                }
            });
        });

        
        // Função para preencher o formulário de exclusão
        window.preencherFormExcluir = function (id) {
            $('#excluirId').val(id);
        }

        // Função para confirmar a exclusão
        window.confirmarExclusao = function () {
            var id = $('#excluirId').val();

            $.ajax({
                url: 'excluir_usuario.php',
                type: 'POST',
                data: { id: id },
                success: function () {
                    carregarUsuarios(); // Atualiza a lista de usuários após a exclusão
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao excluir o usuário: ' + error);
                }
            });
        }

        // Chama a função para carregar a lista de usuários ao carregar a página
        carregarUsuarios();

        // Inicializa os modais
        $('.modal').modal();
    });

    </script>
     <script type="text/javascript" src="js/materialize.js"></script>
</body>

</html>