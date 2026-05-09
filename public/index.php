<?php
session_start();
define('BASE_URL', 'http://localhost:8000');
require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Bootstrap;
(new Bootstrap())->run();