<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Work+Sans">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Crud Cadeiras</title>
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
    <section class="container ">
        <div class="container col s6 offset-s3 borda orange lighten-5 ">
        <div class="row">
        <h3 class="center-align titulo"> Cadastrar Item </h3>
            <article class="col s6 offset-s3">
                <form id="form" onsubmit="return salvarItem(event);">
                    <div class="input-field prefix-active">
                        <!-- <i class="material-icons prefix">phone_iphone</i> -->
                        <label class="active" for="id"> ID </label>
                        <input type="text" name="id" required readonly>
                    </div>

                    <div class="input-field prefix-active">
                        <i class="material-icons prefix">fiber_manual_record</i>
                        <label for="nome"> Nome </label>
                        <input type="text" name="nome" required>
                    </div>

                    <div class="input-field prefix.active">
                        <i class="material-icons prefix">fiber_manual_record</i>
                        <label for="descricao"> Descrição </label>
                        <input type="text" name="descricao" required>
                    </div>

                    <div class="input-field prefix.active">
                        <i class="material-icons prefix">attach_money</i>
                        <label for="preço"> Preço </label>
                        <input type="text" name="preco" required>
                    </div> 

                
                    <p class="center-align">
                        <button class="waves-effect waves-light btn  white-text cyan accent-3 logar " type="submit">Cadastrar Item </button>
                    </p>

                </form>

            </article>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="titulo">
       <h3>Itens</h3>
    </div>
    </section>
<div class="row">
    <article class="col s10 offset-s1 ">
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
        </tbody>
    </table>
    </article>
</div>

<br> <br> <br> <br> <br> <br> <br>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Excluir Item</h4>
        <p>Tem certeza que deseja excluir este item?</p>
    </div>
    <div class="modal-footer center">
        <button id="btn-sim" class="modal-close waves-effect waves-green btn-flat" onclick="excluir();">Sim</button>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Não</a>
    </div>
</div>





    <script>
        function editar(evt) {
            let id = evt.currentTarget.paramId
            let tBody = document.getElementById("itens");
            for (const tr of tBody.children) {
                if (tr.children[0].innerHTML == id) {
                    let id = document.getElementsByName("id")[0];
                    let nome = document.getElementsByName("nome")[0];
                    let descricao = document.getElementsByName("descricao")[0]
                    let preco = document.getElementsByName("preco")[0];
                    id.value = tr.children[0].innerHTML;
                    nome.value = tr.children[1].innerHTML;
                    descricao.value = tr.children[2].innerHTML;
                    preco.value = tr.children[3].innerHTML;
                }
            }
        }
        function salvarItem(event) {
            event.preventDefault();
            let form = document.getElementById("form");
                            let atividade = Object.fromEntries(new FormData(form).entries());
            let editar = false;

            if (atividade.id == "") {
               
                fetch("salvarItem.php", {
                    method: "POST",
                    body: JSON.stringify(atividade), 
                    headers: { 'Content-type': "application/json; charset=UTF-8" }
                })
                    //converte a resposta em json
                    .then(response => response.json())
                    .then(atividade => inserirItem(atividade))
                    .catch(error => console.log(error));
            }else{
                fetch("salvarItem.php", {
                    method: "PUT", //verbo de envio
                    body: JSON.stringify(atividade), //informmações a serem enviadas
                    headers: { 'Content-type': "application/json; charset=UTF-8" }
                })
                    //converte a resposta em json
                    .then(response => response.json())
                    .then(atividade => alterarItem(atividade))
                    .catch(error => console.log(error));


            }

            form.reset();
            return false;

        }


        function inserirItem(atividade) {
            let tr = document.createElement("tr");
            let tdId = document.createElement("td");
            tdId.innerText = atividade.id;
            let tdNome= document.createElement("td");
            tdMaterial.innerText = atividade.nome;
            let tdDescricao = document.createElement("td");
            tdModelo.innerText = atividade.descricao;
            let tdPreço = document.createElement("td");
            tdPreço.innerText = atividade.preço;

            let tdEditar = document.createElement("td");
           // tdEditar.innerText = "Editar";

            let btdEditar = document.createElement("button");
            btdEditar.addEventListener("click", editar, false);
            btdEditar.paramId = atividade.id;
            btdEditar.innerHTML = "Editar";
            btdEditar.classList.add('btn-floating');
                btdEditar.classList.add('waves-effect');
                btdEditar.classList.add('waves-light');
                btdEditar.classList.add('modal-trigger');
                btdEditar.classList.add('#795548');
                btdEditar.classList.add('brown');
                // btdEditar.classList.add('darken-4');
                btdEditar.innerHTML = "<i class='material-icons'>create</i>";
            tdEditar.appendChild(btdEditar);

            let tdExcluir = document.createElement("td");


            let btdExcluir = document.createElement("a");
                btdExcluir.href = '#modal1';
                btdExcluir.addEventListener("click", preencheId, false);
                btdExcluir.paramId = atividade.id;
                btdExcluir.classList.add('btn-floating');
                btdExcluir.classList.add('waves-effect');
                btdExcluir.classList.add('waves-light');
                btdExcluir.classList.add('modal-trigger');
                btdExcluir.classList.add('#795548');
                btdExcluir.classList.add('brown');
                // btdExcluir.classList.add('darken-4');
                btdExcluir.innerHTML = "<i class='material-icons'>delete</i>";
                tdExcluir.appendChild(btdExcluir);

            // let btdExcluir = document.createElement("button");
            // btdExcluir.addEventListener("click", excluir, false);
            // btdExcluir.paramId = atividade.id;
            // btdExcluir.innerHTML = "Excluir";
            // tdExcluir.appendChild(btdExcluir);


            tr.appendChild(tdId);
            tr.appendChild(tdNome);
            tr.appendChild(tdDescricao);
            tr.appendChild(tdPreço);
            tr.appendChild(tdEditar);
            tr.appendChild(tdExcluir);
            let tBody = document.getElementById("itens");
            tBody.appendChild(tr);
        }

        function alterarItem(atividade) {
            let tBody = document.getElementById("itens");
            for (const tr of tBody.children) {
                if (tr.children[0].innerHTML == atividade.id) {
                    tr.children[1].innerHTML = atividade.nome;
                    tr.children[2].innerHTML = atividade.descricao;
                    tr.children[3].innerHTML = atividade.preço;
                }
            }
            
        }

        function excluir() {
                //let id = evt.currentTarget.paramId;
                fetch("excluirItem.php?id=" + id, {
                        method: "GET", //verbo de envio
                        //body: JSON.stringify(atividade), //informmações a serem enviadas
                        headers: {
                            'Content-type': "application/json; charset=UTF-8"
                        }
                    })
                    //converte a resposta em json
                    .then(response => response.json())
                    .then(atividade => excluirItem(atividade))
                    .catch(error => console.log(error));
            }

        // function excluir() {
           
        //     if (excluir == true) {
        //         let id = evt.currentTarget.paramId;
        //         fetch("excluir.php?id=" + id, {
        //             method: "GET", //verbo de envio
        //             //body: JSON.stringify(atividade), //informmações a serem enviadas
        //             headers: { 'Content-type': "application/json; charset=UTF-8" }
        //         })
        //             //converte a resposta em json
        //             .then(response => response.json())
        //             .then(atividade => excluirItem(atividade))
        //             .catch(error => console.log(error));

        //         }        
        //     }
        
            function excluirItem(atividade){
                let tBody = document.getElementById("itens");
                for (const tr of tBody.children) {
                    if (tr.children[0].innerHTML == atividade.id) {
                        tBody.removeChild(tr);
                    }
                }
            }

         function listarTodos(){
            fetch("listarItem.php", {
                    method: "GET", //verbo de envio
                    //body: JSON.stringify(atividade), //informmações a serem enviadas
                    headers: { 'Content-type': "application/json; charset=UTF-8" }
                })
                    //converte a resposta em json
                    .then(response => response.json())
                    .then(itens => inserirItem(itens))
                    .catch(error => console.log(error));


         }

         function inserirItem(itens){
            for (const atividade of itens){
                inserirItem(atividade);
            }
         }


        document.addEventListener("DOMContentLoaded", () => {
                listarTodos();
                var elems = document.querySelectorAll('.modal');
                var instances = M.Modal.init(elems);
            });

            function preencheId(evt) {
                id = evt.currentTarget.paramId;
                /*let id = evt.currentTarget.paramId;
                let btnSim = document.getElementById("btn-sim");
                btnSim.href = "excluir.php?id=" + id;*/
            }
            
            var id = -1;


// Javascript do materialize
                //  $(document).ready(function() {
                // M.updateTextFields();
                //  });


    </script>
</body>

</html>