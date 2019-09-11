<template>
  <div>
    <h1 class="display-3 text-white">Lista de Autores</h1>

    <button
      type="button"
      class="btn btn-sm btn-primary mb-3"
      data-toggle="modal"
      data-target=".bd-example-modal-lg"
      @click="removerAlert"
    >Adicionar Autor</button>

    <div v-if="alertAdicionado" class="alert alert-success">Autor adicionado com sucesso.</div>

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
          <span v-if="props.column.label == 'Livros'">
            <span>{{ props.row.livros.length }}</span>
          </span>
          <span v-else>{{props.formattedRow[props.column.field]}}</span>
        </template>
      </vue-good-table>
    </div>

    <div id="modal-form" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Adicionar Novo Autor</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form-autor @adicionado="notificar"></form-autor>
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

export default {
  data() {
    return {
      columns: [
        {
          label: "Autor",
          field: "nome"
        },
        {
          label: "Livros",
          field: "livros"
        },
      ],
      alertAdicionado: false,
      route: "/api/autores-livros/"
    };
  },

  mixins: [ListasMixin],

  components: {
    VueGoodTable
  },

  methods: {
    redirecionar(params) {
      console.log(params.column.field);
      if (params.column.field === "nome" || params.column.field === "livros") {
        window.location.href = "/autor/" + params.row.id;
      }
    },
  },

  created() {
    this.getDados();
  }
};
</script>