<?php
namespace App\Core;

use App\Controllers\errors\HttpErrorsController;
use Symfony\Component\HttpFoundation\Request;
use Exception;


class Router
{
    public function dispatch(Request $request) : void
    {
        try{
            $url = $request->getPathInfo() ?? '';
            $url = trim($url,'/');
            $parts = $url ? explode('/',$url) : [];
            $controller_name = $parts[0] ?? 'Home';
            $controller_name = 'App\Controllers\\'. ucfirst($controller_name).'Controller';

            if($controller_name === 'App\Controllers\\AdminController' && !isset($_SESSION['admin_true'])  && !isset($_SESSION['guest'])){
                $this->httpError('notFound');
                return;
            }
            if(class_exists($controller_name)){
                $method = $parts[1] ?? 'index';

                $controller = new $controller_name();
                $this->wireRequest($controller, $request);
                
                if(!method_exists($controller, $method)){
                    $this->httpError('notFound');
                    return;
                }
                $params = array_slice($parts,2);
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
        $trace = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS,2);
        $linha = $trace[0]['line'];
        $error_message = "ROTA: $error_message | " . "LINHA: ". $linha;
        $controller->$error($error_message);
    }

    /**
     * Se object controller for instância do Controller, enviamos a instância request pro controller pai
     */
    private function wireRequest(object $controller, Request $request){
        if($controller instanceof Controller){
            $controller->setRequest($request);
        }
    }
}