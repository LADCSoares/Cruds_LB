<!-- Parte do formulário para cadastrar/editar itens -->
<div class="container col s6 offset-s3 borda orange lighten-5">
    <h3 class="center-align titulo">Cadastrar/Editar Item</h3>
    <form id="form" onsubmit="return salvarItem(event);">
        <div class="input-field prefix-active">
            <label class="active" for="id">ID</label>
            <input type="text" name="id" required readonly>
        </div>

        <div class="input-field prefix-active">
            <label for="nome">Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div class="input-field prefix.active">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" required>
        </div>

        <div class="input-field prefix.active">
            <label for="preco">Preço</label>
            <input type="text" name="preco" required>
        </div>

        <p class="center-align">
            <button class="waves-effect waves-light btn #00695c teal darken-3 white-text brown lighten-1" type="submit">
                <i class="material-icons left"></i>Cadastrar
            </button>
        </p>
    </form>
</div>

<!-- Tabela para listar itens -->
<div class="row">
    <article class="col s10 offset-s1">
        <table class="responsive-table striped ftabela">
            <thead class="titulo">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody id="itens">
                <!-- Os itens serão listados aqui dinamicamente -->
            </tbody>
        </table>
    </article>
</div>

<!-- Modais -->
<div id="modalEditar" class="modal">
    <!-- Conteúdo do modal de edição -->
</div>

<div id="modalExcluir" class="modal">
    <div class="modal-content">
        <h4>Excluir Item</h4>
        <p>Tem certeza que deseja excluir o item?</p>
    </div>
    <div class="modal-footer center">
        <button id="btn-sim" class="modal-close waves-effect waves-green btn-flat" onclick="excluir();">Sim</button>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Não</a>
    </div>
</div>

    <script>
        $(document).ready(function() {
            listarItens();
        });

        function listarItens() {
            $.ajax({
                url: 'listarItens.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    exibirItens(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function exibirItens(itens) {
            var tabela = $('#tabelaItens');
            tabela.empty();

            for (var i = 0; i < itens.length; i++) {
                var item = itens[i];
                var linha = $('<tr>');
                linha.append('<td>' + item.id + '</td>');
                linha.append('<td>' + item.nome + '</td>');
                linha.append('<td>' + item.descricao + '</td>');
                linha.append('<td>' + item.preco + '</td>');
                linha.append('<td><button onclick="editarItens(' + item.id + ')">Editar</button> | <button onclick="excluirItens(' + item.id + ')">Excluir</button></td>');

                tabela.append(linha);
            }
        }

        function salvarItem(event) {
            event.preventDefault();
            
            var formData = $('#formItens').serializeArray();
            var item = {};
            
            $.each(formData, function(i, field) {
                item[field.name] = field.value;
            });

            var url = item.id ? 'salvarItens.php' : 'salvarItens.php';

            $.ajax({
                url: url,
                type: item.id ? 'PUT' : 'POST',
                dataType: 'json',
                data: JSON.stringify(item),
                contentType: 'application/json',
                success: function(data) {
                    listarItens();
                    $('#formItens')[0].reset();
                },
                error: function(error) {
                    console.log(error);
                }
            });

            return false;
        }

        function editarItem(id) {
            $.ajax({
                url: 'listarItens.php?id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    preencherFormulario(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function excluirItem(id) {
            $('#modal-confirmacao').modal('open');
            idExclusao = id;
            $.ajax({
                url: 'excluirItens.php?id=' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(data) {
                    listarItens();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function excluir() {
            // Fecha o modal de confirmação
            $('#modal-confirmacao').modal('close');

            // Chama a função para excluir o item
            excluirItem(idExclusao);
        }

        function preencherFormulario(item) {
            $('input[name="id"]').val(item.id);
            $('input[name="nome"]').val(item.nome);
            $('input[name="descricao"]').val(item.descricao);
            $('input[name="preco"]').val(item.preco);
        }
    </script>
</body>
</html>
