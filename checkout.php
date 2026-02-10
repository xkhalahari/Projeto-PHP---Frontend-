<?php
session_start();

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}

$carrinho = $_SESSION['carrinho'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Memories Decor</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function calcularFrete() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            // frete fake por enquanto (depois troca por API)
            let frete = 0;
            if (cep.startsWith('0') || cep.startsWith('1')) frete = 50;
            else if (cep.startsWith('2') || cep.startsWith('3')) frete = 70;
            else frete = 90;

            document.getElementById('frete').innerText = frete.toFixed(2);

            const subtotal = parseFloat(document.getElementById('subtotal').innerText);
            document.getElementById('total').innerText = (subtotal + frete).toFixed(2);
        }

        function enviarWhats() {
            const total = document.getElementById('total').innerText;
            const cep = document.getElementById('cep').value;

            let mensagem = `Olá! Gostaria de fechar meu pedido.%0A`;
            mensagem += `Total: R$ ${total}%0A`;
            mensagem += `CEP: ${cep}`;

            window.open(`https://wa.me/55SEUNUMERO?text=${mensagem}`, '_blank');
        }
    </script>
</head>

<body class="bg-[#FAF9F6]">

<main class="max-w-4xl mx-auto p-8">

    <h1 class="text-3xl mb-8 font-light">Checkout</h1>

    <div class="bg-white rounded-2xl p-6 space-y-6 shadow">

        <h2 class="text-xl font-semibold">Resumo do Pedido</h2>

        <?php foreach ($carrinho as $item): ?>
            <div class="flex justify-between text-sm border-b pb-2">
                <span><?= $item['nome'] ?></span>
                <span>R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
            </div>
            <?php $total += $item['preco']; ?>
        <?php endforeach; ?>

        <div class="flex justify-between font-bold text-lg pt-4">
            <span>Subtotal</span>
            <span>R$ <span id="subtotal"><?= number_format($total, 2, '.', '') ?></span></span>
        </div>

        <div class="space-y-2">
            <label class="block text-sm">CEP para cálculo do frete</label>
            <input
                type="text"
                id="cep"
                maxlength="9"
                placeholder="00000-000"
                onkeyup="calcularFrete()"
                class="w-full border rounded-lg p-3"
            />
        </div>

        <div class="flex justify-between">
            <span>Frete</span>
            <span>R$ <span id="frete">0.00</span></span>
        </div>

        <div class="flex justify-between text-xl font-bold">
            <span>Total</span>
            <span>R$ <span id="total"><?= number_format($total, 2, '.', '') ?></span></span>
        </div>

        <button
            onclick="enviarWhats()"
            class="w-full bg-[#B2C2B2] text-white py-4 rounded-full font-bold hover:scale-105 transition"
        >
            Finalizar pelo WhatsApp
        </button>

    </div>

</main>

</body>
</html>
