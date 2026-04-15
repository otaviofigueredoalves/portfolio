<?php
namespace App\Core;

use App\Controllers\errors\HttpErrorsController;

abstract class Controller
{
    protected function view($view, $view_data = [])
    {
        // dd($view);
        extract($view_data);
        $view_file = __DIR__ . "/../views/$view.php";
        
        if(!file_exists($view_file)){
            throw new \Exception("OBS: O arquivo $view não existe!");
        }
        // dd($view_data);
        require_once $view_file;
    }
}