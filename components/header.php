<?php
// components/header.php
if (session_status() === PHP_SESSION_NONE) session_start();

$paginaAtual = basename($_SERVER['PHP_SELF'] ?? '');

function navLink($arquivo, $label, $paginaAtual) {
  $ativo = ($paginaAtual === $arquivo);
  $class = $ativo
    ? 'text-sage font-bold underline underline-offset-4'
    : 'hover:text-sage transition-colors';

  return "<a href=\"$arquivo\" class=\"$class\">$label</a>";
}
?>

<nav class="bg-white/80 backdrop-blur-md border-b border-sand p-4 flex justify-between items-center sticky top-0 z-50">
  <h1 class="text-xl font-bold text-sage">
    <a href="index.php">Memories<span class="text-terracotta">Decor</span></a>
  </h1>

  <div class="space-x-6 font-medium text-stone-600 flex items-center text-sm">
    <?= navLink('index.php', 'Home', $paginaAtual) ?>
    <?= navLink('catalogo.php', 'Kits', $paginaAtual) ?>
    <?= navLink('sobre.php', 'Sobre', $paginaAtual) ?>
    <?= navLink('carrinho.php', 'Meu Pedido', $paginaAtual) ?>
    <?= navLink('contato.php', 'Contato', $paginaAtual) ?>
  </div>
</nav>
