<?php
// sobre.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Memories Decor | Sobre</title>

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
            terracotta: '#50361dff'
          }
        }
      }
    }
  </script>

  <style>
    body { font-family: 'Quicksand', sans-serif; background-color: #FAF9F6; }
  </style>
</head>

<body class="min-h-screen flex flex-col">

<!-- NAV -->
<nav class="bg-white/80 backdrop-blur-md border-b border-sand p-4 flex justify-between items-center sticky top-0 z-50">
  <h1 class="text-xl font-bold text-sage">
    <a href="index.php">Memories<span class="text-terracotta">Decor</span></a>
  </h1>

  <div class="space-x-6 font-medium text-stone-600 flex items-center text-sm">
    <a href="index.php" class="hover:text-sage transition-colors">Home</a>
    <a href="catalogo.php" class="hover:text-sage transition-colors">Kits</a>
    <a href="sobre.php" class="text-sage font-bold underline underline-offset-4">Sobre</a>
    <a href="carrinho.php" class="hover:text-terracotta transition-colors font-bold">Meu Pedido</a>
    <a href="contato.php" class="hover:text-sage transition-colors">Contato</a>
  </div>
</nav>

<main class="max-w-6xl mx-auto w-full px-6 py-14 flex-grow">

  <!-- HERO -->
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div class="space-y-6">
      <span class="text-terracotta font-black uppercase tracking-[0.35em] text-[10px] italic">
        sobre a marca
      </span>

      <h2 class="text-5xl md:text-6xl font-light text-stone-700 leading-tight">
        A gente transforma <span class="italic text-sage font-semibold">momentos</span> em memória.
      </h2>

      <p class="text-stone-500 leading-relaxed">
        A Memories Decor nasceu para entregar decoração com estética delicada, organizada e profissional — sem dor de cabeça.
        Você escolhe o kit, personaliza com extras e decide se quer retirar ou receber com montagem.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 pt-2">
        <a href="catalogo.php"
           class="bg-sage text-white px-10 py-4 rounded-full font-bold shadow-xl shadow-sage/20 hover:scale-105 transition-all">
          Ver Kits
        </a>
        <a href="contato.php"
           class="bg-white border border-sand px-10 py-4 rounded-full font-bold text-stone-600 hover:shadow-sm transition">
          Falar com a equipe
        </a>
      </div>
    </div>

    <div class="bg-white border border-sand rounded-[2.5rem] p-6 shadow-sm">
      <div class="rounded-[2rem] overflow-hidden">
        <!-- Troque por uma imagem sua quando quiser -->
        <img
          src="https://images.unsplash.com/photo-1524253482453-3fed8d2fe12b?w=1200"
          alt="Decoração Memories Decor"
          class="w-full h-[360px] object-cover"
        >
      </div>

      <div class="pt-6 grid grid-cols-3 gap-4 text-center">
        <div class="bg-cream border border-sand/60 rounded-2xl p-4">
          <p class="text-2xl font-black text-stone-700">+120</p>
          <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">eventos</p>
        </div>
        <div class="bg-cream border border-sand/60 rounded-2xl p-4">
          <p class="text-2xl font-black text-stone-700">4.9★</p>
          <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">avaliações</p>
        </div>
        <div class="bg-cream border border-sand/60 rounded-2xl p-4">
          <p class="text-2xl font-black text-stone-700">24h</p>
          <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">resposta</p>
        </div>
      </div>
    </div>
  </section>

  <!-- COMO FUNCIONA -->
  <section class="mt-16">
    <h3 class="text-3xl font-light text-stone-700 mb-8">
      Como <span class="italic text-sage font-semibold">funciona</span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white border border-sand rounded-[2.5rem] p-8 shadow-sm">
        <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">passo 1</p>
        <h4 class="text-xl font-bold text-stone-700 mt-2">Escolha o kit</h4>
        <p class="text-stone-500 mt-3 text-sm leading-relaxed">
          Navegue no catálogo, veja fotos, descrição e itens inclusos. Escolha o kit ideal pro seu evento.
        </p>
      </div>

      <div class="bg-white border border-sand rounded-[2.5rem] p-8 shadow-sm">
        <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">passo 2</p>
        <h4 class="text-xl font-bold text-stone-700 mt-2">Personalize</h4>
        <p class="text-stone-500 mt-3 text-sm leading-relaxed">
          Adicione extras (neon, arranjos premium, mesa de doces etc.) e escolha Pegue e Monte ou Montagem.
        </p>
      </div>

      <div class="bg-white border border-sand rounded-[2.5rem] p-8 shadow-sm">
        <p class="text-[10px] uppercase tracking-widest font-black text-stone-400">passo 3</p>
        <h4 class="text-xl font-bold text-stone-700 mt-2">Feche e pronto</h4>
        <p class="text-stone-500 mt-3 text-sm leading-relaxed">
          Confirme o orçamento, escolha pagamento e acompanhe tudo com clareza. Sem bagunça, sem surpresa.
        </p>
      </div>
    </div>
  </section>

  <!-- DIFERENCIAIS -->
  <section class="mt-16">
    <h3 class="text-3xl font-light text-stone-700 mb-8">
      Nossos <span class="italic text-sage font-semibold">diferenciais</span>
    </h3>

    <div class="bg-white border border-sand rounded-[2.5rem] p-8 shadow-sm">
      <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-stone-600">
        <li class="bg-cream border border-sand/60 rounded-2xl p-5">
          <span class="font-black text-stone-700">✨ Estética consistente</span>
          <p class="text-sm mt-2 text-stone-500">Paleta pastel, organização visual e composição elegante.</p>
        </li>
        <li class="bg-cream border border-sand/60 rounded-2xl p-5">
          <span class="font-black text-stone-700">📦 Opções de logística</span>
          <p class="text-sm mt-2 text-stone-500">Retirada com instrução ou entrega com montagem.</p>
        </li>
        <li class="bg-cream border border-sand/60 rounded-2xl p-5">
          <span class="font-black text-stone-700">🧾 Transparência</span>
          <p class="text-sm mt-2 text-stone-500">Total calculado com extras + serviço + frete.</p>
        </li>
        <li class="bg-cream border border-sand/60 rounded-2xl p-5">
          <span class="font-black text-stone-700">💬 Atendimento rápido</span>
          <p class="text-sm mt-2 text-stone-500">Contato direto para dúvidas e personalizações.</p>
        </li>
      </ul>
    </div>
  </section>

</main>

<footer class="bg-white border-t border-sand py-10 px-6 mt-auto text-[10px] uppercase font-bold tracking-widest text-stone-400">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
    <h4 class="text-sage text-lg leading-none font-bold">Memories<span class="text-terracotta">Decor</span></h4>
    <div class="flex gap-8">
      <a href="https://instagram.com" target="_blank" class="hover:text-sage transition-colors">Instagram</a>
      <a href="https://t.me" target="_blank" class="hover:text-sky-500 transition-colors">Telegram</a>
      <a href="https://wa.me/5500000000000" target="_blank" class="hover:text-green-500 transition-colors">WhatsApp</a>
    </div>
    <p>© 2026 Memories Decor.</p>
  </div>
</footer>

</body>
</html>
