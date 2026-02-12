<?php
session_start();
require_once __DIR__ . '/data/kits.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Memories Decor | Kits</title>

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
        terracotta: '#D4A373',
        berry: '#9e1560'
      }
    }
  }
}
</script>

<style>
body{
  font-family:'Quicksand',sans-serif;
  background:#FAF9F6;
}

/* brilho suave animado */
@keyframes glow {
  0% { box-shadow: 0 0 0px rgba(158,21,96,0); }
  50% { box-shadow: 0 0 40px rgba(158,21,96,0.25); }
  100% { box-shadow: 0 0 0px rgba(158,21,96,0); }
}

/* leve flutuação */
@keyframes floaty {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-6px); }
  100% { transform: translateY(0px); }
}

.card-hover:hover {
  transform: translateY(-10px) scale(1.02);
  animation: glow 2s infinite ease-in-out;
}

.card-hover {
  transition: all 0.5s ease;
}

/* botão luxo */
.btn-premium {
  position: relative;
  overflow: hidden;
  transition: all .4s ease;
}

.btn-premium::after{
  content:'';
  position:absolute;
  top:0;
  left:-100%;
  width:100%;
  height:100%;
  background: linear-gradient(120deg, transparent, rgba(255,255,255,.4), transparent);
  transition:.6s;
}

.btn-premium:hover::after{
  left:100%;
}

.badge-new{
  position:absolute;
  top:15px;
  left:15px;
  background:#D4A373;
  color:white;
  font-size:10px;
  padding:6px 12px;
  border-radius:999px;
  letter-spacing:1px;
  text-transform:uppercase;
  animation: floaty 3s ease-in-out infinite;
}
</style>

<script src="assets/js/carrinho.js" defer></script>
</head>

<body class="flex flex-col min-h-screen">

<?php require_once __DIR__ . '/components/header.php'; ?>

<main class="max-w-7xl mx-auto px-6 py-20 flex-grow">

<h2 class="text-5xl mb-16 text-center text-stone-700 font-light">
  Nossos <span class="italic font-semibold text-berry">Kits</span>
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-14">

<?php foreach ($kits as $kit): ?>
  
  <div class="card-hover bg-white/70 backdrop-blur-xl rounded-[3rem] border border-sand shadow-xl overflow-hidden flex flex-col relative">

    <div class="badge-new">Novo</div>

    <!-- IMAGEM -->
    <div class="relative bg-cream h-[420px] overflow-hidden">
      <img
        src="<?= htmlspecialchars($kit['imagem']) ?>"
        alt="<?= htmlspecialchars($kit['nome']) ?>"
        class="w-full h-full object-cover object-center transition duration-700 hover:scale-110"
      >
    </div>

    <!-- CONTEÚDO -->
    <div class="p-8 flex flex-col flex-grow space-y-5">

      <h3 class="text-2xl font-bold text-stone-700 tracking-wide">
        <?= htmlspecialchars($kit['nome']) ?>
      </h3>

      <p class="text-sm text-stone-500 leading-relaxed">
        <?= htmlspecialchars($kit['descricao']) ?>
      </p>

      <ul class="text-xs text-stone-400 list-disc ml-4 space-y-1">
        <?php foreach ($kit['itens'] as $item): ?>
          <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="mt-4 text-2xl font-bold text-sage">
        R$ <?= number_format((float)$kit['preco'], 2, ',', '.') ?>
      </div>

      <button
        type="button"
        onclick='adicionarAoCarrinho(<?= json_encode($kit, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>)'
        class="btn-premium mt-auto bg-berry hover:bg-[#7f114b] text-white py-4 rounded-full font-bold shadow-lg hover:scale-105 transition-all">
        ✨ Adicionar ao Carrinho
      </button>

    </div>

  </div>

<?php endforeach; ?>

</div>

</main>

<?php require_once __DIR__ . '/components/footer.php'; ?>

</body>
</html>
