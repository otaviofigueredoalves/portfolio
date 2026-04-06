<?php
namespace App\Core;

class Request
{
    /** Vai pegar qualquer post/get recente de onde ela foi chamada */
    public function input($key, $default = NULL)
    {
        if(isset($_POST[$key])){
            return trim($_POST[$key]);
        }

        if(isset($_GET[$key])){
            return trim($_GET[$key]);
        }

        return $default;
    }

    /** Só pra simplificar o processo de comparação se é um envio de form get ou post */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /** No caso de uma requisição ser POST mas possuir algum "código de rastreio" (através do ?) o método irá devolver um array com chaves e valores do post e do get */
    public function all()
    {
        return array_merge($_GET, $_POST);
    }
}