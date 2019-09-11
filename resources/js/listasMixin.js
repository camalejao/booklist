export default {
    data() {
        return {
            dados: [],
            disponivel: true,
            route: '',
        }
    },
    methods: {
        notificar(value) {
            this.alertAdicionado = value;
            if (value) {
                $("#modal-form").modal("hide");
                this.dados = [];
                this.getDados();
            }
        },
        removerAlert() {
            this.alertAdicionado = false;
        },
        getDados() {
            window.axios.get(this.route).then(({ data }) => {
                console.log(data);
                data.forEach(dado => {
                    this.dados.push(dado);
                });
            });
        },
        onRowMouseover(params) {
            document.body.style.cursor = "pointer";
        },
        onRowMouseleave(params) {
            document.body.style.cursor = "default";
        }
    }
}