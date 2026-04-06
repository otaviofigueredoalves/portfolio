<?php
namespace App\Core;

use App\Controllers\errors\HttpErrorsController;
use App\Controllers\HomeController;
use App\Traits\LoggerTrait;
use Exception;

class Router
{
    public function dispatch($url)
    {
        try{
            $url = trim($url,'/');
            $parts = $url ? explode('/',$url) : [];
            $controller_name = $parts[0] ?? 'Home';
            $controller_name = 'App\Controllers\\'. ucfirst($controller_name).'Controller';

            if($controller_name === 'App\Controllers\\AdminController' && !isset($_SESSION['admin_true'])){
                $this->httpError('notFound');
                return;
            }
            if(class_exists($controller_name)){
                $method = $parts[1] ?? 'index';

                $controller = new $controller_name();
                
                if(!method_exists($controller, $method)){
                    $this->httpError('notFound');
                    return;
                }
                $params = array_slice($parts,2);
                // dd($params, $controller);
                call_user_func_array([$controller,$method],$params);
            } else {
                $this->httpError('notFound');
                return;
            }
        } catch (\Exception $e){
            $this->httpError('notServer', $e->getMessage());
        }
    }

    private function httpError($error, $error_message = NULL)
    {
        $controller = new HttpErrorsController();
        /** Pra economizar RAM, é melhor usar o debug_backtrace com o parâmetro DEBUG_BACKTRACE_IGNORE_ARGS,2, pois o debug_backtrace() faz um raio x completo de tudo que está rodando naquele milissegundo, o que acaba se tornando pesado em ambiente em produção. */
        $trace = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS,2);
        $linha = $trace[0]['line'];
        // dd($trace);
        $error_message = "ROTA: $error_message | " . "LINHA: ". $linha;
        $controller->$error($error_message);
    }
}