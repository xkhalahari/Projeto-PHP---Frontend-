<?php
declare(strict_types=1);

session_start();
header('Content-Type: application/json; charset=utf-8');

// evita que qualquer warning/notice quebre o JSON
ini_set('display_errors', '0');

$raw = file_get_contents('php://input');
$dados = json_decode($raw, true);

if (!is_array($dados)) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'erro' => 'JSON inválido']);
  exit;
}

$id = isset($dados['id']) ? (int)$dados['id'] : 0;
$nome = isset($dados['nome']) ? trim((string)$dados['nome']) : '';
$preco = isset($dados['preco']) ? (float)$dados['preco'] : 0.0;
$imagem = isset($dados['imagem']) ? trim((string)$dados['imagem']) : '';

if ($id <= 0 || $nome === '' || $preco <= 0) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'erro' => 'Dados do kit incompletos']);
  exit;
}

if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

// adiciona item
$_SESSION['carrinho'][] = [
  'id' => $id,
  'nome' => $nome,
  'preco' => $preco,
  'imagem' => $imagem
];

echo json_encode(['ok' => true, 'qtd' => count($_SESSION['carrinho'])]);
exit;
