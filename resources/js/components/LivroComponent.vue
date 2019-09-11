<template>
  <div v-if="livro.id">
    <div class="card mb-3 bg-light">
      <div v-if="carregado" class="card-body">
        <h1>{{ livro.titulo }}</h1>

        <h5>
          Autor:
          <a :href="'/autor/' + livro.autor_id">{{ livro.autor.nome }}</a>
        </h5>

        <br />
        <br />

        <p class="h4">{{ livro.descricao }}</p>

        <br />

        <h5>Status: {{ this.mostrarStatus(livro.status) }}</h5>

        <h5 v-if="livro.avaliacao != null">Nota: {{ livro.avaliacao }}</h5>
        <h5 v-else>Nota: -</h5>

        <div v-if="alert" class="mt-3 alert alert-success">Alterações no livro salvas.</div>
      </div>
    </div>
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#modal-form"
      @click="removerAlert"
    >Editar Livro</button>

    <button
      type="button"
      class="btn btn-danger ml-2"
      data-toggle="modal"
      data-target="#modal-excluir"
    >Excluir Livro</button>

    <div id="modal-form" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Editar Livro</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <editar-livro :livro="livro" @alterado="notificar"></editar-livro>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir Livro</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Tem certeza que deseja excluir o livro {{ livro.titulo }}?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" @click="excluir">Excluir</button>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div v-else>
    <h1 class="text-light">Nenhum Resultado Encontrado :(</h1>
  </div>
</template>

<script>
import LivroMixin from "../livroMixin";

export default {
  mixins: [LivroMixin],

  props: ["id"],

  data() {
    return {
      alert: false,
      livro: {},
      carregado: false
    };
  },

  methods: {
    getLivro() {
      axios.get("/api/livros/" + this.$props.id).then(({ data }) => {
        this.livro = data;
        this.carregado = true;
      });
    },
    notificar(value) {
      this.alert = value;
      if(value){
        this.getLivro();
        $("#modal-form").modal("hide");      
      }
    },
    removerAlert() {
      this.alert = false;
    },
    excluir() {
      axios.delete("/api/livros/" + this.$props.id);
    }
  },

  created() {
    this.getLivro();
  }
};
</script>
