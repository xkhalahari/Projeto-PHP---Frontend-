document.addEventListener('alpine:init', () => {
    Alpine.data('loja', () => ({
        kits: KITS_DECORACAO,
        carrinho: [],
        abrirCarrinho: false,
        servico: 'retirada',
        distancia: 0,
        taxaMontagem: 120,
        valorKm: 2.50,

        adicionar(kit) {
            this.carrinho.push(kit);
            this.abrirCarrinho = true;
        },

        remover(index) {
            this.carrinho.splice(index, 1);
        },

        get subtotal() {
            return this.carrinho.reduce((sum, item) => sum + item.preco, 0);
        },

        get totalFrete() {
            return (this.distancia || 0) * this.valorKm;
        },

        get totalGeral() {
            let total = this.subtotal + this.totalFrete;
            if (this.servico === 'montagem') total += this.taxaMontagem;
            return total;
        },

        formatar(valor) {
            return valor.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
        },

        enviarWhatsapp() {
            const f = this.formatar.bind(this);
            let msg = `*Solicitação de Orçamento*%0A%0A`;
            this.carrinho.forEach(k => msg += `- ${k.nome} (${f(k.preco)})%0A`);
            msg += `%0A*Serviço:* ${this.servico === 'montagem' ? 'Com Montagem' : 'Pegue e Monte'}`;
            msg += `%0A*Distância:* ${this.distancia} km`;
            msg += `%0A*TOTAL ESTIMADO:* ${f(this.totalGeral)}`;
            
            window.open(`https://wa.me/5511999999999?text=${msg}`); // Troque pelo seu número
        }
    }))
});