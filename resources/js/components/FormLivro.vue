<template>
    <form @submit.stop.prevent="submit">

        <div class="form-group">
            <label for="titulo">Título</label>
            <input required type="text" class="form-control" name="titulo" id="titulo" v-model="fields.titulo"/>
            <div v-if="errors && errors.titulo" class="text-danger">{{ errors.titulo[0] }}</div>
        </div>

        <div class="form-group">
            <label for="autor_id">Autor</label>
            <select class="form-control" name="autor_id" id="autor_id" v-model="fields.autor_id">
                <option v-for="autor in autores" :key="autor.id" :value="autor.id">{{ autor.nome }}</option>
            </select>
             <div v-if="errors && errors.autor_id" class="text-danger">{{ errors.autor_id[0] }}</div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea required class="form-control" name="descricao" id="descricao" rows="5" v-model="fields.descricao"></textarea>
            <div v-if="errors && errors.descricao" class="text-danger">{{ errors.descricao[0] }}</div>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input required type="text" class="form-control" name="categoria" id="categoria" v-model="fields.categoria"/>
            <div v-if="errors && errors.categoria" class="text-danger">{{ errors.categoria[0] }}</div>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select required class="form-control" name="status" id="status" v-model="fields.status">
                <option v-for="(stat, key) in status" v-bind:key="key" :value="key">{{ stat }}</option>
            </select>
            <div v-if="errors && errors.status" class="text-danger">{{ errors.status[0] }}</div>
        </div>

        <div class="form-group">
            <label for="avaliacao">Avaliação</label>
            <select class="form-control" name="avaliacao" id="avaliacao" v-model="fields.avaliacao">
                <option v-for="(av, key) in avaliacoes" v-bind:key="key" :value="key">{{ key }} - {{ av }}</option>
            </select>
             <div v-if="errors && errors.avaliacao" class="text-danger">{{ errors.avaliacao[0] }}</div>
        </div>
        <button v-if="disponivel" type="submit" class="btn btn-block btn-primary">Adicionar</button>
        <button v-else disabled class="btn btn-block btn-disabled">Adicionar</button>
    </form>
</template>

<script>
    import CadastroMixin from '../cadastroMixin';
    import LivroMixin from '../livroMixin';

    export default {
        mixins: [ CadastroMixin, LivroMixin ],

        data() {
            return {
                autores: [],
                fields: {},
                action: '/api/livros',
            }
        },

        methods: {
            getAutores() {
                axios.get('/api/autores/').then(({ data }) => {
                    console.log(data);
                    data.forEach(autor => {
                        this.autores.push(autor);
                    });
                });
            }
        },

        created() {
            this.getAutores();
        }
    }
</script>