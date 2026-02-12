<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Memories Decor | Home</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            sage: '#9e1560',
            cream: '#faf6f8',
            sand: '#e9d9e3',
            terracotta: '#50361dff'
          }
        }
      }
    }
  </script>

  <style>body{font-family:'Quicksand',sans-serif;background:#FAF9F6;}</style>
</head>

<body class="flex flex-col min-h-screen">

<?php require_once __DIR__ . '/components/header.php'; ?>

<header class="relative h-[80vh] flex items-center justify-center text-center px-6 overflow-hidden">
  <div class="max-w-4xl">
    <span class="text-terracotta font-bold uppercase tracking-[0.4em] text-[10px] mb-4 block italic">
      Sejam bem-vindos!
    </span>

    <h2 class="text-6xl md:text-8xl font-light text-stone-700 leading-tight">
      Celebrar é criar <span class="italic text-sage font-semibold">afeto</span>.
    </h2>

    <p class="text-stone-500 mt-6 text-lg max-w-2xl mx-auto">
      Escolha um kit, personalize com extras e feche seu pedido com total calculado.
    </p>

    <div class="mt-12 flex flex-col md:flex-row gap-6 justify-center">
      <a href="catalogo.php"
         class="bg-sage text-white px-12 py-5 rounded-full font-bold shadow-xl shadow-sage/20 hover:scale-105 transition-all text-lg">
        Explorar Catálogo
      </a>

      <a href="sobre.php"
         class="bg-white border border-sand px-12 py-5 rounded-full font-bold text-stone-700 hover:shadow-sm transition-all text-lg">
        Conhecer a marca
      </a>
    </div>
  </div>
</header>

<?php require_once __DIR__ . '/components/footer.php'; ?>

</body>
</html>
