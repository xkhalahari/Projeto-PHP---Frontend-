<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$_SESSION['carrinho'][] = [
    'id' => $data['id'],
    'nome' => $data['nome'],
    'preco' => $data['preco']
];

echo json_encode(['status' => 'ok']);
