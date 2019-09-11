<template>
  <form @submit.stop.prevent="submit">
    <div class="form-group">
      <label for="titulo">Nome</label>
      <input required type="text" class="form-control" name="nome" id="nome" v-model="$props.autor.nome" />
      <div v-if="errors && errors.nome" class="text-danger">{{ errors.nome[0] }}</div>
    </div>

    <button v-if="disponivel" type="submit" class="btn btn-block btn-primary">Salvar</button>
    <button v-else disabled class="btn btn-block btn-disabled">Salvar</button>
  </form>
</template>

<script>
    export default {

        props: {
            autor: { type: Object, required: true }
        },

        data() {
            return {
                errors: {},
                disponivel: true,
                action: '/api/autores/',
            }
        },

        methods: {
            submit() {
                if (this.disponivel) {

                    this.disponivel = false;
                    this.$emit('alterado', false);
                    this.errors = {};
                
                    axios.put(this.action + this.autor.id, this.autor).then(response => {
                        this.disponivel = true;
                        this.$emit('alterado', true);
                    }).catch(error => {
                        if (error.response.status === 422) {
                            this.disponivel = true;
                            this.errors = error.response.data.errors || {};
                        }
                    });
                }
            }
        }
    }
</script>