<template>
    <form @submit.stop.prevent="submit">

        <div class="form-group">
            <label for="titulo">Nome</label>
            <input required type="text" class="form-control" name="nome" id="nome" v-model="fields.nome"/>
            <div v-if="errors && errors.nome" class="text-danger">{{ errors.nome[0] }}</div>
        </div>

        <button v-if="disponivel" type="submit" class="btn btn-block btn-primary">Adicionar</button>
        <button v-else disabled class="btn btn-block btn-disabled">Adicionar</button>
    </form>
</template>

<script>
    import CadastroMixin from '../cadastroMixin';

    export default {
        mixins: [ CadastroMixin ],

        data() {
            return {
                fields: {},
                action: '/api/autores',
            }
        },
    }
</script>