<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class Controller
{
    protected Request $request;

    public function setRequest($request) : void
    {
        $this->request = $request;
    }
    
    
    protected function view($view, $view_data = [])
    {
        extract($view_data);
        $view_file = __DIR__ . "/../views/$view.php";
        
        if(!file_exists($view_file)){
            throw new \Exception("OBS: O arquivo $view não existe!");
        }
        require_once $view_file;
    }

    public function json(array $data, int $statusCode = 200) : never
    {
        $response = new JsonResponse($data, $statusCode);
        $response->send();
        exit;
    }

    public function redirect(string $url, int $statusCode = 301) : never
    {
        $response = new RedirectResponse($url, $statusCode);
        $response->send();
        exit;
    }
}