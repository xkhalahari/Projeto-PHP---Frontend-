<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Memories Decor | Contato</title>

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
</head>

<body class="flex flex-col min-h-screen">

<?php require_once __DIR__ . '/components/header.php'; ?>

<main class="max-w-6xl mx-auto px-6 py-16 flex-grow">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

    <div class="space-y-8">
      <h2 class="text-4xl font-light text-stone-700">
        Onde nos <span class="italic text-sage font-semibold">encontrar</span>.
      </h2>

      <div class="grid gap-4">
        <a href="https://wa.me/5500000000000" target="_blank"
           class="flex items-center p-6 bg-white border border-sand rounded-[2rem] hover:shadow-md transition-all">
          <div class="bg-green-500 p-3 rounded-2xl mr-4 text-white text-xl">📱</div>
          <div>
            <h4 class="font-bold text-stone-700">WhatsApp</h4>
            <p class="text-[10px] text-stone-400 font-black uppercase">Atendimento Direto</p>
          </div>
        </a>

        <a href="https://instagram.com" target="_blank"
           class="flex items-center p-6 bg-white border border-sand rounded-[2rem] hover:shadow-md transition-all">
          <div class="bg-gradient-to-tr from-yellow-400 to-purple-600 p-3 rounded-2xl mr-4 text-white text-xl">📸</div>
          <div>
            <h4 class="font-bold text-stone-700">Instagram</h4>
            <p class="text-[10px] text-stone-400 font-black uppercase">Catálogo & Fotos</p>
          </div>
        </a>

        <a href="https://t.me" target="_blank"
           class="flex items-center p-6 bg-white border border-sand rounded-[2rem] hover:shadow-md transition-all">
          <div class="bg-sky-500 p-3 rounded-2xl mr-4 text-white text-xl">✈️</div>
          <div>
            <h4 class="font-bold text-stone-700">Telegram</h4>
            <p class="text-[10px] text-stone-400 font-black uppercase">Canal de Novidades</p>
          </div>
        </a>
      </div>
    </div>

    <div class="bg-white p-10 rounded-[3rem] border border-sand shadow-sm">
      <form onsubmit="enviarWhats(event)" class="space-y-6">
        <input id="nome" type="text" required placeholder="Seu Nome"
               class="w-full bg-cream rounded-2xl p-4 outline-none focus:ring-2 focus:ring-sage font-bold text-stone-600">

        <textarea id="mensagem" rows="4" required placeholder="Sua Mensagem"
                  class="w-full bg-cream rounded-2xl p-4 outline-none focus:ring-2 focus:ring-sage font-bold text-stone-600"></textarea>

        <button type="submit"
                class="w-full bg-sage text-white py-5 rounded-2xl font-bold shadow-lg shadow-sage/20 uppercase tracking-widest text-xs hover:scale-[1.02] transition-all">
          Enviar para WhatsApp
        </button>
      </form>
    </div>

  </div>
</main>

<?php require_once __DIR__ . '/components/footer.php'; ?>

<script>
function enviarWhats(e){
  e.preventDefault();
  const nome = document.getElementById('nome').value;
  const msg  = document.getElementById('mensagem').value;

  const texto = encodeURIComponent(`Olá! Meu nome é ${nome}.\n\nMensagem:\n${msg}`);
  window.open(`https://wa.me/5500000000000?text=${texto}`, '_blank');
}
</script>

</body>
</html>
