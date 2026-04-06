<?php
namespace App\Controllers\errors;

use App\Core\Controller;
use App\Traits\LoggerTrait;

class HttpErrorsController extends Controller
{
    use LoggerTrait;
    public function notFound($error_msg)
    {
        \http_response_code(404);
        $this->log("Rota inexistente. Detalhe: $error_msg");
        $this->view('errors_pages/404');
    }
    public function notServer($error_msg)
    {
        \http_response_code(500);
        $this->log("Problema no servidor. Detalhe: $error_msg");
        $this->view('errors_pages/500');
    }
}