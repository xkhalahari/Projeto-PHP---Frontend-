<?php
session_start();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'kits.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Memories Decor | Kits</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="assets/js/carrinho.js" defer></script>

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
</head>

<body>

<nav class="bg-white p-4 flex justify-between border-b border-sand">
    <h1 class="font-bold text-sage text-xl">Memories<span class="text-terracotta">Decor</span></h1>
    <div class="space-x-6 text-sm">
        <a href="index.php">Home</a>
        <a href="catalogo.php" class="font-bold text-sage">Kits</a>
        <a href="carrinho.php">Meu Pedido</a>
        <a href="contato.php">Contato</a>
    </div>
</nav>

<main class="max-w-6xl mx-auto px-6 py-16">
    <h2 class="text-4xl mb-12 text-stone-700 font-light">
        Nossos <span class="italic text-sage font-semibold">Kits</span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <?php foreach ($kits as $kit): ?>
        <div class="bg-white rounded-[2.5rem] border border-sand overflow-hidden shadow-sm">

            <img src="<?= $kit['imagem'] ?>" alt="<?= $kit['nome'] ?>" class="w-full h-56 object-cover">

            <div class="p-6 space-y-4">
                <h3 class="text-xl font-bold text-stone-700"><?= $kit['nome'] ?></h3>
                <p class="text-sm text-stone-500"><?= $kit['descricao'] ?></p>

                <ul class="text-xs text-stone-400 list-disc ml-4">
                    <?php foreach ($kit['itens'] as $item): ?>
                        <li><?= $item ?></li>
                    <?php endforeach; ?>
                </ul>

                <p class="text-lg font-bold text-sage">
                    R$ <?= number_format($kit['preco'], 2, ',', '.') ?>
                </p>

                <button
                    onclick='adicionarAoCarrinho(<?= json_encode($kit) ?>)'
                    class="w-full bg-sage text-white py-3 rounded-full font-bold hover:scale-105 transition">
                    Adicionar ao Carrinho
                </button>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</main>

</body>
</html>
