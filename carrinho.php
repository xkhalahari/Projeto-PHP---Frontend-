<?php
session_start();

// Garante que existe um carrinho na sessão
if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

$carrinho = $_SESSION['carrinho'];

// subtotal (somente kits adicionados)
$subtotal = 0.0;
foreach ($carrinho as $it) {
  $subtotal += (float)($it['preco'] ?? 0);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Memories Decor | Meu Pedido</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            sage: '#B2C2B2',
            cream: '#FAF9F6',
            sand: '#E9E4D9',
            terracotta: '#D4A373'
          }
        }
      }
    }
  </script>

  <style>
    body { font-family: 'Quicksand', sans-serif; background-color: #FAF9F6; }
  </style>

  <script>
    // Dados para o carrinho.js
    window.__SUBTOTAL__ = <?= json_encode($subtotal) ?>;
    window.__CART__ = <?= json_encode($carrinho) ?>;
  </script>

  <script src="assets/js/carrinho.js" defer></script>
</head>

<body class="min-h-screen flex flex-col">

<!-- NAV -->
<nav class="bg-white border-b border-sand p-4 flex justify-between items-center sticky top-0 z-50">
  <h1 class="text-xl font-bold text-sage">
    <a href="index.php">Memories<span class="text-terracotta">Decor</span></a>
  </h1>

  <div class="space-x-6 font-medium text-stone-600 flex items-center text-sm">
    <a href="index.php" class="hover:text-sage transition-colors">Home</a>
    <a href="catalogo.php" class="hover:text-sage transition-colors">Kits</a>
    <a href="carrinho.php" class="text-terracotta font-bold underline underline-offset-4">Meu Pedido</a>
    <a href="contato.php" class="hover:text-sage transition-colors">Contato</a>
  </div>
</nav>

<main class="max-w-6xl mx-auto w-full px-6 py-14 flex-grow">
  <div class="flex items-end justify-between gap-6 mb-10">
    <div>
      <h2 class="text-4xl font-light text-stone-700">🛒 Seu <span class="italic text-sage font-semibold">Pedido</span></h2>
      <p class="text-stone-400 text-sm mt-2">
        Revise seus kits, selecione extras e siga para o pagamento.
      </p>
    </div>

    <a href="catalogo.php"
       class="hidden md:inline-flex items-center gap-2 bg-white border border-sand px-6 py-3 rounded-full font-bold text-stone-600 hover:shadow-sm transition">
      + Adicionar mais kits
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- COLUNA ESQUERDA: ITENS -->
    <section class="lg:col-span-2 space-y-6">

      <?php if (count($carrinho) === 0): ?>
        <div class="bg-white border border-sand rounded-[2.5rem] p-10 text-center">
          <p class="text-stone-500 italic">Seu carrinho está vazio.</p>
          <a href="catalogo.php"
             class="inline-block mt-6 bg-sage text-white px-8 py-4 rounded-full font-bold hover:scale-105 transition">
            Explorar Kits
          </a>
        </div>
      <?php else: ?>

        <div class="bg-white border border-sand rounded-[2.5rem] p-8">
          <h3 class="text-xl font-bold text-stone-700 mb-6">Itens selecionados</h3>

          <div class="space-y-4">
            <?php foreach ($carrinho as $i => $item): ?>
              <div class="flex gap-4 items-center bg-cream rounded-[2rem] p-4 border border-sand/60">
                <img
                  src="<?= htmlspecialchars($item['imagem'] ?? '') ?>"
                  alt="<?= htmlspecialchars($item['nome'] ?? 'Kit') ?>"
                  class="w-20 h-20 rounded-2xl object-cover bg-white border border-sand"
                  onerror="this.style.display='none'"
                >
                <div class="flex-1 min-w-0">
                  <p class="font-bold text-stone-700 truncate">
                    <?= htmlspecialchars($item['nome'] ?? 'Kit') ?>
                  </p>
                  <p class="text-sm font-bold text-sage">
                    R$ <?= number_format((float)($item['preco'] ?? 0), 2, ',', '.') ?>
                  </p>
                </div>

                <button
                  type="button"
                  onclick="removerItem(<?= (int)$i ?>)"
                  class="text-red-400 hover:text-red-600 font-black text-xs uppercase tracking-widest"
                  title="Remover">
                  Remover
                </button>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mt-6 pt-6 border-t border-sand flex items-center justify-between">
            <p class="text-stone-500 font-bold">Subtotal (kits)</p>
            <p class="text-stone-800 font-black text-lg">
              <span id="subtotal"><?= "R$ " . number_format($subtotal, 2, ',', '.') ?></span>
            </p>
          </div>
        </div>

        <!-- EXTRAS -->
        <div class="bg-white border border-sand rounded-[2.5rem] p-8">
          <div class="flex items-center justify-between gap-6 mb-4">
            <h3 class="text-xl font-bold text-stone-700">Extras (opcional)</h3>
            <span class="text-[10px] uppercase tracking-widest font-black text-stone-400">adicionais</span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
              // Extras fixos (você pode trocar depois por extras por kit)
              $extrasFixos = [
                ["nome" => "Letreiro Neon", "preco" => 120],
                ["nome" => "Arranjo floral premium", "preco" => 150],
                ["nome" => "Topo de bolo personalizado", "preco" => 45],
                ["nome" => "Mesa de doces extra", "preco" => 220],
              ];
            ?>

            <?php foreach ($extrasFixos as $ex): ?>
              <label class="flex items-center gap-3 bg-cream border border-sand/60 rounded-2xl p-4 cursor-pointer hover:shadow-sm transition">
                <input
                  type="checkbox"
                  class="extra w-5 h-5 accent-sage"
                  data-nome="<?= htmlspecialchars($ex['nome']) ?>"
                  data-preco="<?= (float)$ex['preco'] ?>"
                >
                <div class="flex-1">
                  <p class="font-bold text-stone-700 text-sm"><?= htmlspecialchars($ex['nome']) ?></p>
                  <p class="text-xs font-black text-stone-400 uppercase tracking-widest">
                    + <?= "R$ " . number_format((float)$ex['preco'], 2, ',', '.') ?>
                  </p>
                </div>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

      <?php endif; ?>

    </section>

    <!-- COLUNA DIREITA: CHECKOUT -->
    <aside class="bg-white border border-sand rounded-[2.5rem] p-8 h-fit space-y-6">
      <div class="flex items-center justify-between">
        <h3 class="text-xl font-bold text-stone-700">Finalização</h3>
        <span class="text-[10px] uppercase tracking-widest font-black text-stone-400">resumo</span>
      </div>

      <!-- SERVIÇO -->
      <div class="space-y-3">
        <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest">Serviço</p>

        <label class="flex items-center justify-between gap-4 bg-cream border border-sand/60 rounded-2xl p-4 cursor-pointer">
          <div class="flex items-center gap-3">
            <input type="radio" name="servico" value="retirada" checked class="accent-sage">
            <div>
              <p class="font-bold text-stone-700 text-sm">📦 Pegue e Monte</p>
              <p class="text-xs text-stone-400">Cliente retira e monta.</p>
            </div>
          </div>
          <span class="font-black text-stone-600 text-sm">R$ 0,00</span>
        </label>

        <label class="flex items-center justify-between gap-4 bg-cream border border-sand/60 rounded-2xl p-4 cursor-pointer">
          <div class="flex items-center gap-3">
            <input type="radio" name="servico" value="montagem" class="accent-sage">
            <div>
              <p class="font-bold text-stone-700 text-sm">✨ Com montagem</p>
              <p class="text-xs text-stone-400">Inclui equipe no local.</p>
              <p class="text-xs text-stone-400 mt-1">
                Distância calculada automaticamente: <span id="km_auto" class="font-bold text-stone-600">—</span>
              </p>
            </div>
          </div>
          <span class="font-black text-stone-600 text-sm">+ R$ 150,00</span>
        </label>
      </div>

      <!-- CEP / FRETE -->
      <div class="space-y-3">
        <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest">Frete por CEP</p>

        <input
          id="cep"
          type="text"
          inputmode="numeric"
          maxlength="9"
          placeholder="00000-000"
          class="w-full bg-cream rounded-2xl p-4 outline-none focus:ring-2 focus:ring-sage font-bold text-stone-700"
          oninput="mascaraCEP(this)"
        >

        <button
          type="button"
          onclick="calcularFrete()"
          class="w-full bg-sage text-white py-4 rounded-2xl font-bold hover:scale-[1.01] transition shadow-lg shadow-sage/15"
        >
          Calcular frete
        </button>

        <p class="text-xs text-stone-400">
          O frete entra automaticamente no total após o CEP estar completo.
        </p>
      </div>

      <!-- RESUMO -->
      <div class="pt-4 border-t border-sand space-y-3 text-stone-700">
        <div class="flex justify-between text-sm">
          <span>Subtotal (kits)</span>
          <span id="subtotal"><?= "R$ " . number_format($subtotal, 2, ',', '.') ?></span>
        </div>

        <div class="flex justify-between text-sm">
          <span>Extras</span>
          <span id="extras">R$ 0,00</span>
        </div>

        <div class="flex justify-between text-sm">
          <span>Serviço</span>
          <span id="servico_val">R$ 0,00</span>
        </div>

        <div class="flex justify-between text-sm">
          <span>Frete</span>
          <span id="frete">R$ 0,00</span>
        </div>

        <div class="pt-3 border-t border-sand flex justify-between text-xl font-black">
          <span>Total</span>
          <span id="total"><?= "R$ " . number_format($subtotal, 2, ',', '.') ?></span>
        </div>
      </div>

      <!-- BOTÃO ALTERADO: VAI PARA PAGAMENTO -->
      <a
        href="checkout.php"
        class="w-full block text-center bg-terracotta text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition shadow-lg shadow-terracotta/20
        <?php if (count($carrinho) === 0) echo ' pointer-events-none opacity-50'; ?>"
      >
        Ir para Pagamento
      </a>

      <p class="text-[10px] text-stone-400 uppercase tracking-widest font-bold text-center">
        Checkout✨
      </p>
    </aside>

  </div>
</main>

<footer class="bg-white border-t border-sand py-10 px-6 mt-auto text-[10px] uppercase font-bold tracking-widest text-stone-400">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
    <h4 class="text-sage text-lg leading-none font-bold">Memories<span class="text-terracotta">Decor</span></h4>
    <div class="flex gap-8">
      <a href="https://instagram.com" target="_blank" class="hover:text-sage transition-colors">Instagram</a>
      <a href="https://t.me" target="_blank" class="hover:text-sky-500 transition-colors">Telegram</a>
      <a href="https://wa.me/5500000000000" target="_blank" class="hover:text-green-500 transition-colors">WhatsApp</a>
    </div>
    <p>© 2026.</p>
  </div>
</footer>

</body>
</html>
