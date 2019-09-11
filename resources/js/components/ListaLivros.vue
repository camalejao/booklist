<template>
  <div>
    <h1 class="display-3 text-white">Lista de Livros</h1>

    <button
      type="button"
      class="btn btn-sm btn-primary mb-3"
      data-toggle="modal"
      data-target=".bd-example-modal-lg"
      @click="removerAlert"
    >Adicionar Livro</button>

    <div v-if="alertAdicionado" class="alert alert-success">Livro adicionado com sucesso.</div>

    <div class="card mb-3">
      <vue-good-table
        :columns="columns"
        :rows="dados"
        :search-options="{
                enabled: true
            }"
        :sort-options="{
                enabled: true,
            }"
        :pagination-options="{
                enabled: true
            }"
        @on-cell-click="redirecionar"
        @on-row-mouseenter="onRowMouseover"
        @on-row-mouseleave="onRowMouseleave"
      >
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'status'">
            <span>{{ mostrarStatus(props.row.status) }}</span>
          </span>
          <span v-else-if="props.column.field == 'avaliacao' && props.row.avaliacao == null">
            <span>-</span>
          </span>
          <span v-else>{{props.formattedRow[props.column.field]}}</span>
        </template>
      </vue-good-table>
    </div>

    <div id="modal-form" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Adicionar Novo Livro</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form-livro @adicionado="notificar"></form-livro>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "vue-good-table/dist/vue-good-table.css";
import { VueGoodTable } from "vue-good-table";
import ListasMixin from "../listasMixin";
import LivroMixin from "../livroMixin";

export default {
  data() {
    return {
      columns: [
        {
          label: "Título",
          field: "titulo"
        },
        {
          label: "Autor",
          field: "autor.nome"
        },
        {
          label: "Status",
          field: "status"
        },
        {
          label: "Avaliação",
          field: "avaliacao",
          type: "number",
          tdClass: 'text-left',
          thClass: 'text-left',
        },
      ],
      alertAdicionado: false,
      route: "/api/livros/"
    };
  },

  components: {
    VueGoodTable
  },

  mixins: [ListasMixin, LivroMixin],

  methods: {
    redirecionar(params) {
      console.log(params.column.field);
      if (params.column.field === "titulo" || params.column.field === "status") {
        window.location.href = "/livro/" + params.row.id;
      } else if (params.column.field === "autor.nome") {
        window.location.href = "/autor/" + params.row.autor_id;
      }
    },
  },

  created() {
    this.getDados();
  }
};
</script>