<?php
namespace App\Core;

class Request
{
    /** Vai pegar qualquer post/get recente de onde ela foi chamada */
    public function input($key, $default = NULL)
    {
        if(isset($_POST[$key])){
            return $_POST[$key];
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

    public function getImage()
    {
        $img_name = null;
         if(isset($_FILES['project_img']) && $_FILES['project_img']['error'] === UPLOAD_ERR_OK){

            $img_name = $_FILES['project_img']['name'];
            $path = __DIR__ . '/../../public/assets/images/projects_img/'. $img_name;

            move_uploaded_file($_FILES['project_img']['tmp_name'], $path);
        }
        return $img_name;
    }
}