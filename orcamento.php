<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Memories Decor | Orçamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<nav class="bg-white border-b border-sand p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-sage">
        Memories<span class="text-terracotta">Decor</span>
    </h1>
</nav>

<main class="max-w-4xl mx-auto px-6 py-16 flex-grow space-y-10">

    <h2 class="text-3xl font-light text-stone-700">
        Resumo do <span class="italic text-sage font-semibold">Orçamento</span>
    </h2>

    <!-- CEP -->
    <div class="bg-white p-6 rounded-3xl border border-sand space-y-4">
        <label class="text-xs font-bold uppercase text-stone-400">CEP para frete</label>
        <input
            id="cep"
            type="text"
            placeholder="00000-000"
            class="w-full bg-cream p-4 rounded-2xl"
        >
        <button
            onclick="calcularFretePorCEP()"
            class="bg-sage text-white py-3 px-6 rounded-full font-bold">
            Calcular Frete
        </button>
    </div>

    <!-- RESUMO -->
    <div class="bg-white p-8 rounded-3xl border border-sand space-y-4 text-stone-700">
        <div class="flex justify-between"><span>Kit</span><span id="valor-kit">R$ 0,00</span></div>
        <div class="flex justify-between"><span>Extras</span><span id="valor-extras">R$ 0,00</span></div>
        <div class="flex justify-between"><span>Serviço</span><span id="valor-servico">R$ 0,00</span></div>
        <div class="flex justify-between"><span>Frete</span><span id="valor-frete">R$ 0,00</span></div>

        <div class="border-t pt-4 flex justify-between font-bold text-xl">
            <span>Total</span>
            <span id="total">R$ 0,00</span>
        </div>
    </div>

    <button
        onclick="enviarWhats()"
        class="w-full bg-terracotta text-white py-5 rounded-full font-bold uppercase tracking-widest">
        Enviar orçamento pelo WhatsApp
    </button>

</main>

<script src="carrinho.js"></script>

</body>
</html>
