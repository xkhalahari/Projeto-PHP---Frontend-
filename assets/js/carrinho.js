// ===============================
// CONFIGURAÇÕES
// ===============================
const VALOR_MONTAGEM = 150;
const VALOR_POR_KM = 2.5;
const WHATSAPP_NUMERO = "5500000000000";

// ===============================
// ENTRADA DO CARRINHO (CATÁLOGO)
// ===============================
function adicionarAoCarrinho(kit) {
    fetch("carrinho_add.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(kit)
    })
    .then(res => res.json())
    .then(() => {
        window.location.href = "carrinho.php";
    })
    .catch(err => {
        alert("Erro ao adicionar ao carrinho");
        console.error(err);
    });
}

// ===============================
// ESTADO GLOBAL
// ===============================
let carrinho = {
    valorBase: 0,
    extras: [],
    servico: "retirada",
    distancia: 0,
    frete: 0,
    cep: ""
};

// ===============================
// INICIALIZAÇÃO (quando vem do PHP)
// ===============================
function iniciarCarrinho(valorKit) {
    carrinho.valorBase = parseFloat(valorKit) || 0;
    calcularTotal();
}

// ===============================
// CÁLCULO TOTAL
// ===============================
function calcularTotal() {
    let total = 0;

    total += carrinho.valorBase;

    carrinho.extras.forEach(v => total += v);

    if (carrinho.servico === "montagem") {
        total += VALOR_MONTAGEM;
        total += carrinho.distancia * VALOR_POR_KM;
    }

    total += carrinho.frete;

    atualizarTela(total);
}

// ===============================
// ATUALIZA UI
// ===============================
function atualizarTela(total) {
    if (document.getElementById("valor-kit"))
        document.getElementById("valor-kit").innerText = formatar(carrinho.valorBase);

    if (document.getElementById("valor-extras"))
        document.getElementById("valor-extras").innerText = formatar(
            carrinho.extras.reduce((a, b) => a + b, 0)
        );

    if (document.getElementById("valor-servico"))
        document.getElementById("valor-servico").innerText =
            carrinho.servico === "montagem"
                ? formatar(VALOR_MONTAGEM + carrinho.distancia * VALOR_POR_KM)
                : "R$ 0,00";

    if (document.getElementById("valor-frete"))
        document.getElementById("valor-frete").innerText = formatar(carrinho.frete);

    if (document.getElementById("total"))
        document.getElementById("total").innerText = formatar(total);
}

// ===============================
// CONTROLES
// ===============================
function selecionarKit(valor) {
    carrinho.valorBase = parseFloat(valor);
    calcularTotal();
}

function toggleExtra(checkbox) {
    const valor = parseFloat(checkbox.value);

    if (checkbox.checked) {
        carrinho.extras.push(valor);
    } else {
        carrinho.extras = carrinho.extras.filter(v => v !== valor);
    }

    calcularTotal();
}

function escolherServico(tipo) {
    carrinho.servico = tipo;
    calcularTotal();
}

function atualizarDistancia(valor) {
    carrinho.distancia = parseFloat(valor) || 0;
    calcularTotal();
}

// ===============================
// FRETE POR CEP
// ===============================
function calcularFretePorCEP() {
    const cepInput = document.getElementById("cep").value.replace(/\D/g, "");

    if (cepInput.length !== 8) {
        alert("Digite um CEP válido");
        return;
    }

    carrinho.cep = cepInput;

    const prefixo = parseInt(cepInput.substring(0, 2));
    let frete = 0;

    if (prefixo <= 19) frete = 40;
    else if (prefixo <= 29) frete = 60;
    else if (prefixo <= 39) frete = 80;
    else frete = 100;

    carrinho.frete = frete;
    calcularTotal();
}

// ===============================
// WHATSAPP
// ===============================
function enviarWhats() {
    const totalTexto = document.getElementById("total").innerText;

    let msg =
        `✨ ORÇAMENTO MEMORIES DECOR ✨\n\n` +
        `Kit: ${formatar(carrinho.valorBase)}\n` +
        `Extras: ${formatar(carrinho.extras.reduce((a, b) => a + b, 0))}\n` +
        `Serviço: ${carrinho.servico}\n` +
        `Frete: ${formatar(carrinho.frete)}\n` +
        `CEP: ${carrinho.cep}\n\n` +
        `💰 Total: ${totalTexto}`;

    window.open(
        `https://wa.me/${WHATSAPP_NUMERO}?text=${encodeURIComponent(msg)}`,
        "_blank"
    );
}

// ===============================
// UTIL
// ===============================
function formatar(v) {
    return v.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL"
    });
}
