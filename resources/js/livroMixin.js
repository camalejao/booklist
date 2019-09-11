export default {
    data() {
        return {
            avaliacoes: {
                1: 'Impossível',
                2: 'Péssimo',
                3: 'Muito Ruim',
                4: 'Ruim',
                5: 'Regular',
                6: 'Ok',
                7: 'Bom',
                8: 'Muito Bom',
                9: 'Ótimo',
                10: 'Obra de Arte'
            },
            status: {
                completado: 'Leitura Concluída',
                lendo: 'Leitura em Andamento',
                desejado: 'Leitura Desejada',
                pausado: 'Leitura em Pausa',
                desistido: 'Leitura Desistida'
            },
        }
    },

    methods: {
        mostrarStatus(status) {
            if(status === 'completado')
                return this.status.completado;
            if(status === 'lendo')
                return this.status.lendo;
            if(status === 'desejado')
                return this.status.desejado;
            if(status === 'pausado')
                return this.status.pausado;
            if(status === 'desistido')
                return this.status.desistido;
        },
    },
}