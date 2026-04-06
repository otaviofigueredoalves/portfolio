<?php
define('BASE_URL', 'http://localhost:8000');

require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Router;
use App\Controllers\errors\HttpErrorsController;

try{
    $url = $_GET['url'] ?? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $router = new Router();
    $router->dispatch($url);
} catch (\Exception $e){
    $error = new HttpErrorsController();
    $error->notServer($e);
}