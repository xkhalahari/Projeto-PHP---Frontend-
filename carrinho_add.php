<?php
session_start();
header('Content-Type: application/json');

$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados) {
    echo json_encode(["erro" => "Dados inválidos"]);
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// adiciona o kit ao carrinho
$_SESSION['carrinho'][] = [
    "id" => $dados['id'],
    "nome" => $dados['nome'],
    "preco" => $dados['preco'],
    "imagem" => $dados['imagem']
];

echo json_encode(["ok" => true]);
