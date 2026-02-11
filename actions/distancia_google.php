<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

$config = require __DIR__ . '/../config.php';

$apiKey = $config['GOOGLE_MAPS_API_KEY'] ?? '';
$origem = $config['ORIGEM_ENDERECO'] ?? '';

$cep = isset($_GET['cep']) ? preg_replace('/\D/', '', (string)$_GET['cep']) : '';

if ($apiKey === '' || $origem === '' || strlen($cep) !== 8) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'erro' => 'Config inválida ou CEP inválido']);
  exit;
}

$destino = $cep; // Google aceita CEP como destino
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric'
  . '&origins=' . urlencode($origem)
  . '&destinations=' . urlencode($destino)
  . '&key=' . urlencode($apiKey);

$resp = @file_get_contents($url);

if ($resp === false) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'erro' => 'Falha ao consultar Google']);
  exit;
}

$data = json_decode($resp, true);

if (!is_array($data) || ($data['status'] ?? '') !== 'OK') {
  http_response_code(500);
  echo json_encode(['ok' => false, 'erro' => 'Resposta inválida do Google', 'raw' => $data]);
  exit;
}

$element = $data['rows'][0]['elements'][0] ?? null;
if (!is_array($element) || ($element['status'] ?? '') !== 'OK') {
  http_response_code(500);
  echo json_encode(['ok' => false, 'erro' => 'Não foi possível calcular rota', 'raw' => $data]);
  exit;
}

$meters = (int)($element['distance']['value'] ?? 0);
$km = $meters / 1000;

echo json_encode([
  'ok' => true,
  'km' => $km,
  'texto' => (string)($element['distance']['text'] ?? ''),
]);
