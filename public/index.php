<?php
session_start();
// Detecta automaticamente se está rodando localmente ou no InfinityFree
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
define('BASE_URL', $protocol . $host);
require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Bootstrap;
(new Bootstrap())->run();