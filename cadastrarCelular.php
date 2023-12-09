<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Celulares</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <!--Import Google Icon Font-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Work+Sans">
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
  
        .titulo {
            font-family: "Roboto", sans-serif;
        }

        .topicos{
		            font-family: "Roboto", sans-serif;
		            font-size: 17px;
		            font-weight: 800;
                margin-left: 43px;;
	            }

        .input-field .prefix.active{
            color: black;
        }

        .ftabela{
            font-family: "Work Sans", sans-serif;   
        }

        .borda{
            margin-top: 3%;
            border: 5px solid;
        }

        .centro{
        margin-left: 900px;
      }
  
      .logo1{
        margin-left: 200px;
      }
      .logo2{
        margin-right: 100px;
      }

    </style>

</head> 

<body>
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

    <section class="container ">
        <div class="container col s6 offset-s borda cyan lighten-2 ">
        <div class="row">
        <h3 class="center-align titulo"> Cadastrar Celulares </h3>
            <article class="col s8 offset-s2">

    <form id="formInserir">

            <div class="input-field prefix.active">
            <i class="material-icons prefix">fiber_manual_record</i>
            <label for="marca"> Marca </label>
            <input type="text" id="marca" name="marca" required>
            </div>

            <div class="input-field prefix.active">
            <i class="material-icons prefix">fiber_manual_record</i>
            <label for="modelo"> Modelo </label>
            <input type="text" name="modelo" required>
            </div>

            <div class="input-field prefix.active">
            <i class="material-icons prefix">attach_money</i>
            <label for="preço"> Preço </label>
            <input type="text" name="preço" required>
            </div> 

            <p class="center-align">
                        <button class="waves-effect waves-light btn #00695c teal darken-3 white-text" type="submit"><i class="material-icons left">done_outline</i> Inserir Celular </button>
            </p>

    </form>
    </article>
</div>
</div>
    <hr>
    <br>

    <div class="titulo">
       <h3>Celulares</h3>
    </br>
    </div>
    </section>
    <!-- Tabela de Celulares -->
    <div class="row">
    <article class="col s10 offset-s2 ">
    <table class="responsive-table striped ftabela" border="1" id="tabelaCelulares">
        <thead class="titulo">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="listaCelulares">
            <!-- A lista de celulares será carregada aqui usando Ajax -->
        </tbody>
    </table>
    </article>
</div>
<br> <br> <br> <br> <br> <br> <br>

    <!-- Modal de Edição -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <h4 class="titulo">Editar Celular</h4>
            <br>
            <form id="formEditar">

            <div class="input-field prefix.active">
            <input type="hidden" id="editId" name="id">
            </div>

            <div class="input-field prefix.active">
            <i class="material-icons prefix">fiber_manual_record</i>
            <label for="editMarca">Marca:</label>
            <input type="text" id="editMarca" name="marca" required><br>
            </div>

            <div class="input-field prefix.active">
            <i class="material-icons prefix">fiber_manual_record</i>
            <label for="editModelo">Modelo:</label>
            <input type="text" id="editModelo" name="modelo" required><br>
            </div>

            <div class="input-field prefix.active">
            <i class="material-icons prefix">attach_money</i>
            <label for="editPreco">Preço:</label>
            <input type="text" id="editPreco" name="preco" required><br>
            </div>

                <button class="waves-effect waves-light btn  white-text cyan accent-3 logar" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
    function carregarCelulares() {
        $.ajax({
            url: 'listar_celulares.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var listaCelulares = $('#listaCelulares');
                listaCelulares.empty();

                for (var i = 0; i < data.length; i++) {
                    var botaoEditar = '<button class="waves-effect waves-light btn white-text cyan accent-3 logar btn-editar" data-id="' + data[i].id + '" data-marca="' + data[i].marca +
                        '" data-modelo="' + data[i].modelo + '" data-preco="' + data[i].preco + '">Editar</button>';

                    var botaoExcluir = '<button class="waves-effect waves-light btn  white-text cyan accent-3 logar btn-excluir" data-id="' + data[i].id + '">Excluir</button>';

                    listaCelulares.append('<tr><td>' + data[i].id + '</td><td>' + data[i].marca + '</td><td>' + data[i].modelo +
                        '</td><td>' + data[i].preco +
                        '</td><td>' + botaoEditar + ' ' + botaoExcluir + '</td></tr>');
                }

                // Adiciona o evento de click para o botão excluir
                $('.btn-excluir').click(function () {
                    var id = $(this).data('id');
                    if (confirm("Tem certeza que deseja excluir este celular?")) {
                        excluirCelular(id);
                    }
                });

                // Inicializa o modal
                var modals = document.querySelectorAll('.modal');
                M.Modal.init(modals);
            },
            error: function (xhr, status, error) {
                console.error('Erro ao carregar a lista de celulares: ' + error);
            }
        });
    }

    $('#formInserir').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: 'inserir_celular.php',
            type: 'POST',
            data: formData,
            success: function () {
                carregarCelulares();
                $('#formInserir')[0].reset();
            },
            error: function (xhr, status, error) {
                console.error('Erro ao inserir o celular: ' + error);
            }
        });
    });

    $('#formEditar').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: 'editar_celular.php',
            type: 'POST',
            data: formData,
            success: function () {
                carregarCelulares();
                M.Modal.getInstance($('#modalEditar')).close(); // Feche o modal após a edição
            },
            error: function (xhr, status, error) {
                console.error('Erro ao editar o celular: ' + error);
            }
        });
    });

    $(document).on('click', '.btn-editar', function () {
        var id = $(this).data('id');
        var marca = $(this).data('marca');
        var modelo = $(this).data('modelo');
        var preco = $(this).data('preco');
        preencherFormEditar(id, marca, modelo, preco);
    });

    carregarCelulares();
});

function excluirCelular(id) {
    $.ajax({
        url: 'excluir_celular.php',
        type: 'POST',
        data: { id: id },
        success: function () {
            carregarCelulares();
        },
        error: function (xhr, status, error) {
            console.error('Erro ao excluir o celular: ' + error);
        }
    });
}

function preencherFormEditar(id, marca, modelo, preco) {
    $('#editId').val(id);
    $('#editMarca').val(marca);
    $('#editModelo').val(modelo);
    $('#editPreco').val(preco);
    M.Modal.getInstance($('#modalEditar')).open(); // Abra o modal usando getInstance
}


            carregarCelulares();
        // });
    </script>
     <script type="text/javascript" src="js/materialize.js"></script>
</body>

</html>
