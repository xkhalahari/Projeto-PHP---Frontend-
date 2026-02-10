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
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #FAF9F6;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur-md border-b border-sand p-4 flex justify-between items-center sticky top-0 z-50">
    <h1 class="text-xl font-bold text-sage">
        Memories<span class="text-terracotta">Decor</span>
    </h1>

    <div class="space-x-6 font-medium text-stone-600 flex items-center text-sm">
        <a href="index.php" class="text-sage font-bold underline underline-offset-4">Home</a>
        <a href="catalogo.php" class="hover:text-sage transition-colors">Kits</a>
        <a href="orcamento.php" class="hover:text-terracotta transition-colors font-bold">Meu Pedido</a>
        <a href="contato.php" class="hover:text-sage transition-colors">Contato</a>
    </div>
</nav>

<!-- HERO -->
<header class="relative h-[80vh] flex items-center justify-center text-center px-6 overflow-hidden">
    <div class="max-w-4xl">
        <span class="text-terracotta font-bold uppercase tracking-[0.4em] text-[10px] mb-4 block italic">
            Aesthetic Party Rental
        </span>

        <h2 class="text-6xl md:text-8xl font-light text-stone-700 leading-tight">
            Celebrar é criar <span class="italic text-sage font-semibold">afeto</span>.
        </h2>

        <div class="mt-12 flex flex-col md:flex-row gap-6 justify-center">
            <a href="catalogo.php"
               class="bg-sage text-white px-12 py-5 rounded-full font-bold shadow-xl shadow-sage/20 hover:scale-105 transition-all text-lg">
                Explorar Catálogo
            </a>
        </div>
    </div>
</header>

<!-- FOOTER -->
<footer class="bg-white border-t border-sand py-12 px-6 mt-auto">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] uppercase font-bold tracking-widest text-stone-400">
        <h4 class="text-sage text-lg leading-none font-bold">
            Memories<span class="text-terracotta">Decor</span>
        </h4>

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
