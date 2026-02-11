<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados || !isset($dados['index'])) {
  http_response_code(400);
  echo json_encode(['erro' => 'Índice inválido']);
  exit;
}

$idx = (int)$dados['index'];

if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

if ($idx < 0 || $idx >= count($_SESSION['carrinho'])) {
  http_response_code(400);
  echo json_encode(['erro' => 'Item não encontrado']);
  exit;
}

array_splice($_SESSION['carrinho'], $idx, 1);

echo json_encode(['ok' => true]);
