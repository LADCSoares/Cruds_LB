<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
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
    <a href="logout.php">Logout</a><br>
    <a href="cadastrarCelular.php">Celulares</a>

    <h3>Listagem de Usuários</h3>

    <table border="1">
        <thead>
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
    
    <div id="modalEditar" class="modal">
    <div class="modal-content">
        <h4>Editar Usuário</h4>
        <form id="formEditar">
            <input type="hidden" id="editId" name="id">
            <label for="editNome">Nome:</label>
            <input type="text" id="editNome" name="nome" required><br>

            <label for="editEmail">Email:</label>
            <input type="email" id="editEmail" name="email" required><br>

            <button type="submit">Salvar</button>
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
                            '<td><a class="waves-effect waves-light btn modal-trigger" href="#modalEditar" onclick="preencherFormEditar(' + data[i].id + ')">Editar</a>' +
                            '<a class="waves-effect waves-light btn modal-trigger" href="#modalExcluir" onclick="preencherFormExcluir(' + data[i].id + ')">Excluir</a></td></tr>');
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