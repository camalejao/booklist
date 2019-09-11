<template>
  <div v-if="autor.id">
    <div class="card mb-3 bg-light">
      <div v-if="carregado" class="card-body">
        <h1>{{ autor.nome }}</h1>

        <br />
        <br />

        <h3 v-if="autor.livros.length">Livros</h3>
        <h3 v-else>Não há livros cadastrados para esse autor :(</h3>
        <ul v-if="autor.livros.length" class="list-group">
            <a v-for="livro in autor.livros" :key="livro.id"
                :href="'/livro/' + livro.id"
                class="list-group-item list-group-item-action">
                {{ livro.titulo }}
            </a>
        </ul>

        <div v-if="alert" class="mt-3 alert alert-success">Alterações salvas.</div>
      </div>
    </div>
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#modal-form"
      @click="removerAlert"
    >Editar Autor</button>

    <div id="modal-form" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Editar Autor</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <editar-autor :autor="autor" @alterado="notificar"></editar-autor>
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

export default {
  //mixins: [],

  props: ["id"],

  data() {
    return {
      alert: false,
      autor: {},
      carregado: false
    };
  },

  methods: {
    getAutor() {
      axios.get("/api/autores/" + this.$props.id).then(({ data }) => {
        this.autor = data;
        this.carregado = true;
      });
    },
    notificar(value) {
      this.alert = value;
      if(value){
        $("#modal-form").modal("hide");      
      }
    },
    removerAlert() {
      this.alert = false;
    },
    excluir() {
      axios.delete("/api/autores/" + this.$props.id);
    }
  },

  created() {
    this.getAutor();
  }
};
</script>
