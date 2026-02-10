<div class="carrinho-container">

  <h2>🛒 Seu Carrinho</h2>

  <div class="lista-produtos">
    <?php foreach ($_SESSION['carrinho'] as $item): ?>
      <div class="produto">
        <div class="produto-info">
          <strong><?= $item['nome'] ?></strong>
          <span><?= number_format($item['preco'], 2, ',', '.') ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="resumo">
    <p>Kit: <span id="valor-kit"></span></p>
    <p>Extras: <span id="valor-extras"></span></p>
    <p>Serviço: <span id="valor-servico"></span></p>
    <p>Frete: <span id="valor-frete"></span></p>

    <h3>Total: <span id="total"></span></h3>
  </div>

  <button onclick="enviarWhats()">Finalizar no WhatsApp</button>

</div>
