<?php
session_start();
define('BASE_URL', 'http://localhost:8000');

require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Router;
use App\Controllers\errors\HttpErrorsController;
use Symfony\Component\HttpFoundation\Request;

try{
    $request = Request::createFromGlobals();
    $router = new Router();
    $router->dispatch($request);
} catch (\Exception $e){
    $error = new HttpErrorsController();
    $error->notServer($e);
}