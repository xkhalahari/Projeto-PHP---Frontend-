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
            terracotta: '#D4A373'
          }
        }
      }
    }
  </script>

  <style>body{font-family:'Quicksand',sans-serif;background:#FAF9F6;}</style>

  <script src="assets/js/carrinho.js" defer></script>
</head>

<body class="flex flex-col min-h-screen">

<?php require_once __DIR__ . '/components/header.php'; ?>

<main class="max-w-6xl mx-auto px-6 py-16 flex-grow">
  <h2 class="text-4xl mb-12 text-stone-700 font-light">
    Nossos <span class="italic text-sage font-semibold">Kits</span>
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    <?php foreach ($kits as $kit): ?>
      <div class="bg-white rounded-[2.5rem] border border-sand overflow-hidden shadow-sm hover:shadow-lg transition-all">

        <img src="<?= htmlspecialchars($kit['imagem']) ?>" alt="<?= htmlspecialchars($kit['nome']) ?>" class="w-full h-56 object-cover">

        <div class="p-6 space-y-4">
          <h3 class="text-xl font-bold text-stone-700"><?= htmlspecialchars($kit['nome']) ?></h3>
          <p class="text-sm text-stone-500"><?= htmlspecialchars($kit['descricao']) ?></p>

          <ul class="text-xs text-stone-400 list-disc ml-4">
            <?php foreach ($kit['itens'] as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
          </ul>

          <p class="text-lg font-bold text-sage">
            R$ <?= number_format((float)$kit['preco'], 2, ',', '.') ?>
          </p>

          <button
            type="button"
            onclick='adicionarAoCarrinho(<?= json_encode($kit, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>)'
            class="w-full bg-sage text-white py-3 rounded-full font-bold hover:scale-105 transition">
            Adicionar ao Carrinho
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php require_once __DIR__ . '/components/footer.php'; ?>

</body>
</html>
