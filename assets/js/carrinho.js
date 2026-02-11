const CONFIG = {
  WHATSAPP_NUMERO: "5500000000000",
  TAXA_MONTAGEM_FIXA: 150,
  VALOR_POR_KM_MONTAGEM: 2.5
};

function onlyDigits(v) { return (v || "").toString().replace(/\D/g, ""); }
function brl(n) { return (Number(n) || 0).toLocaleString("pt-BR",{style:"currency",currency:"BRL"}); }
function el(id) { return document.getElementById(id); }
function safeText(id, value) { const node = el(id); if (node) node.innerText = value; }

function jsonFetch(url, options) {
  return fetch(url, options).then(async (res) => {
    const text = await res.text();
    let data;
    try { data = text ? JSON.parse(text) : null; }
    catch { throw new Error(`Resposta inválida do servidor:\n${text}`); }
    if (!res.ok) throw new Error((data && data.erro) ? data.erro : `Erro HTTP ${res.status}`);
    return data;
  });
}

// --------- carrinho (catálogo)
function adicionarAoCarrinho(kit) {
  const payload = { id: kit.id, nome: kit.nome, preco: kit.preco, imagem: kit.imagem || "" };
  jsonFetch("actions/add_carrinho.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  })
    .then(() => window.location.href = "carrinho.php")
    .catch((err) => { console.error(err); alert("Erro ao adicionar ao carrinho:\n" + err.message); });
}

function removerItem(index) {
  jsonFetch("actions/remover_carrinho.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ index })
  })
    .then(() => window.location.reload())
    .catch((err) => { console.error(err); alert("Erro ao remover item:\n" + err.message); });
}

// --------- estado
const state = {
  subtotal: 0,
  extras: [],
  servico: "retirada",
  kmMontagem: 0,
  frete: 0,
  cep: ""
};

function initFromPage() {
  if (typeof window.__SUBTOTAL__ !== "undefined") state.subtotal = Number(window.__SUBTOTAL__) || 0;
}

function extrasTotal() { return state.extras.reduce((s, e) => s + (Number(e.preco) || 0), 0); }

function servicoTotal() {
  if (state.servico !== "montagem") return 0;
  return CONFIG.TAXA_MONTAGEM_FIXA + (Number(state.kmMontagem) || 0) * CONFIG.VALOR_POR_KM_MONTAGEM;
}

function totalGeral() {
  return (Number(state.subtotal) || 0) + extrasTotal() + servicoTotal() + (Number(state.frete) || 0);
}

function atualizarResumo() {
  safeText("subtotal", brl(state.subtotal));
  safeText("extras", brl(extrasTotal()));
  safeText("servico_val", brl(servicoTotal()));
  safeText("frete", brl(state.frete));
  safeText("total", brl(totalGeral()));

  // se você tiver um lugar na UI para mostrar km (opcional)
  safeText("km_auto", (state.kmMontagem ? `${state.kmMontagem.toFixed(1)} km` : "—"));
}

// --------- sync do DOM
function syncExtrasFromDOM() {
  state.extras = [];
  document.querySelectorAll("input.extra:checked").forEach((cb) => {
    state.extras.push({ nome: cb.dataset.nome || "Extra", preco: Number(cb.dataset.preco) || 0 });
  });
}

function syncServicoFromDOM() {
  const s = document.querySelector("input[name='servico']:checked");
  state.servico = s ? s.value : "retirada";
}

// --------- Frete e Distância via CEP
function mascaraCEP(input) {
  let v = onlyDigits(input.value).slice(0, 8);
  if (v.length > 5) v = v.slice(0, 5) + "-" + v.slice(5);
  input.value = v;

  const cep = onlyDigits(input.value);
  state.cep = cep;

  if (cep.length === 8) {
    calcularFrete();
    calcularDistanciaGoogle();
  } else {
    state.frete = 0;
    state.kmMontagem = 0;
    atualizarResumo();
  }
}

function calcularFrete() {
  const cepEl = el("cep");
  if (!cepEl) return;

  const cep = onlyDigits(cepEl.value);
  state.cep = cep;
  if (cep.length !== 8) return;

  // frete demo por prefixo (troca depois por API real se quiser)
  const prefixo = parseInt(cep.substring(0, 2), 10);
  let frete = 0;

  if (prefixo <= 19) frete = 40;
  else if (prefixo <= 29) frete = 60;
  else if (prefixo <= 39) frete = 80;
  else frete = 100;

  state.frete = frete;
  atualizarResumo();
}

function calcularDistanciaGoogle() {
  // só precisa calcular km se o serviço for montagem
  syncServicoFromDOM();
  if (state.servico !== "montagem") {
    state.kmMontagem = 0;
    atualizarResumo();
    return;
  }

  const cepEl = el("cep");
  if (!cepEl) return;

  const cep = onlyDigits(cepEl.value);
  if (cep.length !== 8) return;

  // chama endpoint PHP que consulta Google
  fetch(`actions/distancia_google.php?cep=${encodeURIComponent(cep)}`)
    .then((r) => r.json())
    .then((data) => {
      if (!data || !data.ok) return;
      state.kmMontagem = Number(data.km) || 0;
      atualizarResumo();
    })
    .catch((err) => console.error(err));
}

// --------- recalcular
function recalcularTotais() {
  syncExtrasFromDOM();
  syncServicoFromDOM();

  // se trocar serviço para montagem, recalcula distância via CEP automaticamente
  if (state.servico === "montagem") {
    calcularDistanciaGoogle();
  } else {
    state.kmMontagem = 0;
  }

  atualizarResumo();
}

// --------- WhatsApp
function enviarWhatsApp() {
  const itens = (window.__CART__ && Array.isArray(window.__CART__)) ? window.__CART__ : [];
  let texto = `✨ *ORÇAMENTO MEMORIES DECOR* ✨\n\n`;

  if (itens.length) {
    texto += `🛒 *Itens:*\n`;
    itens.forEach((it) => texto += `- ${it.nome} (${brl(it.preco)})\n`);
  }

  if (state.extras.length) {
    texto += `\n🎀 *Extras:*\n`;
    state.extras.forEach((e) => texto += `- ${e.nome} (${brl(e.preco)})\n`);
  }

  texto += `\n📦 *Serviço:* ${state.servico === "montagem" ? "Com montagem" : "Pegue e Monte"}`;
  if (state.servico === "montagem") texto += `\n📍 *Distância (auto):* ${state.kmMontagem.toFixed(1)} km`;

  texto += `\n🚚 *CEP:* ${state.cep || "não informado"}`;
  texto += `\n🚚 *Frete:* ${brl(state.frete)}`;
  texto += `\n\n💰 *Subtotal:* ${brl(state.subtotal)}`;
  texto += `\n➕ *Extras:* ${brl(extrasTotal())}`;
  texto += `\n🧰 *Serviço:* ${brl(servicoTotal())}`;
  texto += `\n✅ *TOTAL:* ${brl(totalGeral())}`;

  window.open(`https://wa.me/${CONFIG.WHATSAPP_NUMERO}?text=${encodeURIComponent(texto)}`, "_blank");
}

// --------- init
window.addEventListener("load", () => {
  initFromPage();

  if (el("total") || el("subtotal")) recalcularTotais();

  document.body.addEventListener("change", (e) => {
    if (e.target.matches("input.extra")) recalcularTotais();
    if (e.target.matches("input[name='servico']")) recalcularTotais();
  });

  const cep = el("cep");
  if (cep && !cep.getAttribute("data-mask")) {
    cep.setAttribute("data-mask", "1");
    cep.addEventListener("input", () => mascaraCEP(cep));
  }
});

// expõe pro HTML
window.adicionarAoCarrinho = adicionarAoCarrinho;
window.removerItem = removerItem;
window.calcularFrete = calcularFrete;
window.mascaraCEP = mascaraCEP;
window.enviarWhatsApp = enviarWhatsApp;
