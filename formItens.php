<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Itens</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <h2>CRUD de Itens</h2> 

    Formulário de Inserção
    <form id="formInserir">
        <label for="nome">Nome do Item:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br>

        <button type="submit">Inserir Item</button>
    </form>

    <hr>

    <!-- Tabela de Celulares -->
    <table border="1" id="tabelaItens">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="listaItens">
            <!-- A lista de celulares será carregada aqui usando Ajax -->
        </tbody>
    </table>

    <!-- Modal de Edição -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <h4>Editar Item</h4>
            <form id="formEditar">
                <input type="hidden" id="editId" name="id">
                <label for="editNome">Marca:</label>
                <input type="text" id="editNome" name="nome" required><br>

                <label for="editDescricao">Descrição:</label>
                <input type="text" id="editDescricao" name="descricao" required><br>

                <label for="editPreco">Preço:</label>
                <input type="text" id="editPreco" name="preco" required><br>

                <button type="submit">Salvar</button>
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
            url: 'listar_itens.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var listaCelulares = $('#listaItens');
                listaCelulares.empty();

                for (var i = 0; i < data.length; i++) {
                    var botaoEditar = '<button class="btn-editar" data-id="' + data[i].id + '" data-marca="' + data[i].marca +
                        '" data-modelo="' + data[i].modelo + '" data-preco="' + data[i].preco + '">Editar</button>';

                    var botaoExcluir = '<button class="btn-excluir" data-id="' + data[i].id + '">Excluir</button>';

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
