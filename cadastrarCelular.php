<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Celulares</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</head>

<body>
    <h2>CRUD de Celulares</h2>

    <!-- Formulário de Inserção -->
    <form id="formInserir">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br>

        <button type="submit">Inserir Celular</button>
    </form>

    <hr>

    <!-- Tabela de Celulares -->
    <table border="1" id="tabelaCelulares">
        <thead>
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

    <!-- Modal de Edição -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <h4>Editar Celular</h4>
            <form id="formEditar">
                <input type="hidden" id="editId" name="id">
                <label for="editMarca">Marca:</label>
                <input type="text" id="editMarca" name="marca" required><br>

                <label for="editModelo">Modelo:</label>
                <input type="text" id="editModelo" name="modelo" required><br>

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
                    url: 'listar_celulares.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var listaCelulares = $('#listaCelulares');
                        listaCelulares.empty();

                        for (var i = 0; i < data.length; i++) {
                            var botaoEditar = '<button class="btn-editar" data-id="' + data[i].id + '" data-marca="' + data[i].marca +
                                '" data-modelo="' + data[i].modelo + '" data-preco="' + data[i].preco + '">Editar</button>';

                            var botaoExcluir = '<button class="btn-excluir" data-id="' + data[i].id + '">Excluir</button>';

                            listaCelulares.append('<tr><td>' + data[i].id + '</td><td>' + data[i].marca + '</td><td>' + data[i].modelo +
                                '</td><td>' + data[i].preco +
                                '</td><td>' + botaoEditar + ' ' + botaoExcluir + '</td></tr>');
                        }
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
                        $('#modalEditar').modal('close');
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

            $(document).on('click', '.btn-excluir', function () {
                var id = $(this).data('id');
                if (confirm("Tem certeza que deseja excluir este celular?")) {
                    excluirCelular(id);
                }
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
                $('#modalEditar').modal('open');
            }

            carregarCelulares();
        });
    </script>
</body>

</html>
