<?php
session_start();

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header("Location: carrinho.php");
    exit;
}

$carrinho = $_SESSION['carrinho'];
$total = 0;

foreach ($carrinho as $item) {
    $total += (float)$item['preco'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Memories Decor | Pagamento</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Quicksand', sans-serif; background-color: #FAF9F6; }
</style>
</head>

<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-[#E9E4D9] p-4 flex justify-between">
<h1 class="font-bold text-[#B2C2B2] text-xl">
Memories<span class="text-[#D4A373]">Decor</span>
</h1>
</nav>

<main class="max-w-3xl mx-auto px-6 py-16 flex-grow">

<h2 class="text-3xl font-light text-stone-700 mb-8">
Escolha a forma de <span class="italic text-[#B2C2B2] font-semibold">Pagamento</span>
</h2>

<div class="bg-white p-8 rounded-[2.5rem] border border-[#E9E4D9] space-y-6">

<?php foreach ($carrinho as $item): ?>
<div class="flex justify-between text-sm border-b pb-2">
<span><?= htmlspecialchars($item['nome']) ?></span>
<span>R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
</div>
<?php endforeach; ?>

<div class="flex justify-between font-bold text-lg pt-4">
<span>Total</span>
<span>R$ <?= number_format($total, 2, ',', '.') ?></span>
</div>

<div class="space-y-4 pt-6">

<label class="flex items-center gap-3 bg-[#FAF9F6] p-4 rounded-2xl cursor-pointer">
<input type="radio" name="pagamento" value="pix" checked>
<span class="font-bold">💳 Pix</span>
</label>

<label class="flex items-center gap-3 bg-[#FAF9F6] p-4 rounded-2xl cursor-pointer">
<input type="radio" name="pagamento" value="cartao">
<span class="font-bold">💳 Cartão de Crédito</span>
</label>

<label class="flex items-center gap-3 bg-[#FAF9F6] p-4 rounded-2xl cursor-pointer">
<input type="radio" name="pagamento" value="boleto">
<span class="font-bold">📄 Boleto</span>
</label>

</div>

<button
onclick="confirmarPedido()"
class="w-full bg-[#D4A373] text-white py-5 rounded-2xl font-bold hover:scale-105 transition mt-6">
Confirmar Pedido
</button>

</div>

</main>

<script>
function confirmarPedido() {
    const pagamento = document.querySelector('input[name="pagamento"]:checked').value;
    alert("Pedido confirmado via " + pagamento + ". (Aqui você pode integrar Mercado Pago ou Stripe)");
}
</script>

</body>
</html>
