<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Criar Novo Estudante</div>
                   
                   <div class="card-body">
                    
                        <form>
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" v-model="nome" class="form-control" id="nome" placeholder="Nome">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"  v-model="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Digite seu email">
                            </div>
                            
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="number" v-model="telefone" class="form-control" id="telefone" placeholder="Telefone">
                            </div>
                            
                            <button type="submit" @click.prevent ="salvarEstudante" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Visualizar Estudantes</div>
                   
                   <div class="card-body">
                    <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(estudante,index) in estudantes.data" :key="estudante.id">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{estudante.nome}}</td>
                        <td>{{estudante.email}}</td>
                        <td>{{estudante.telefone}}</td>
                        <td>
                            <button type="button" @click="editarEstudante(estudante.id)" class="btn btn-primary" data-toggle="modal" data-target="#editar">Editar</button>
                            <button type="button" @click="deletarEstudante(estudante.id)" class="btn btn-danger" data-toggle="modal" data-target="#">Deletar</button>
                        </td>
                        </tr>
                    </tbody>
                </table>
                    <pagination :data="estudantes" @pagination-change-page="getResults"></pagination>    
                    </div>
                </div>
            </div>
        </div>
            <!-- Modal -->
            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editar">Editar Estudante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" v-model="editarNome" class="form-control" id="nome" placeholder="Nome">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"  v-model="editarEmail" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Digite seu email">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="number" v-model="editarTelefone" class="form-control" id="telefone" placeholder="Telefone">
                            </div>
      
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" @click.prevent ="atualizarEstudante" data-dismiss="modal" class="btn btn-success">Atualizar</button>
                </div>
                </div>
            </div>
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                estudantes: {},
                id: '',
                nome: '',
                email: '',
                telefone: '',
                editarNome: '',
                editarEmail: '',
                editarTelefone: '',

            }
        },
        mounted() {
            this.getResults();
        },
        methods : {
            salvarEstudante(){
                axios.post('salvar_estudante',{
                    nome : this.nome,
                    email: this.email,
                    telefone: this.telefone
                })
                .then(response => {
                    this.nome = '';
                    this.email= '';
                    this.telefone = '';
                    this.getResults();
                });
            },
            getResults(page = 1) {
			axios.get('visualizar_estudante?page=' + page)
				.then(response => {
                    console.log(response.data);
					this.estudantes = response.data;
				});
		    },
            editarEstudante(id){
                axios.get('editar_estudante/'+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editarNome = response.data.nome;
                    this.editarEmail = response.data.email;
                    this.editarTelefone = response.data.telefone;
                });    
            },
            atualizarEstudante(id){
                axios.put('atualizar_estudante',{
                    id : this.id,
                    nome : this.editarNome,
                    email : this.editarEmail,
                    telefone : this.editarTelefone,
                })
                .then(response=>{
                    this.getResults();
                    });
            },
            deletarEstudante(id){
                axios.delete('deletar_estudante/'+id)
                 .then(response=>{
                    this.getResults();
                    });
            }
        }
    }
</script>