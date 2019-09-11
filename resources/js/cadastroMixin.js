export default {
    data() {
        return {
            fields: {},
            errors: {},
            disponivel: true,
            action: '',
        }
    },
    methods: {
        submit() {
            if (this.disponivel) {

                this.disponivel = false;
                this.$emit('adicionado', false);
                this.errors = {};
                
                axios.post(this.action, this.fields).then(response => {
                    this.fields = {};
                    this.$emit('adicionado', true);
                    this.disponivel = true;
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.disponivel = true;
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
    },
}