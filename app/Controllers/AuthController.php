<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\AdminModel;

class AuthController extends Controller
{
    private $request;
    private $modelAdmin;
    public function __construct()
    {
        $this->request = new Request();
        $this->modelAdmin = new AdminModel();
    }
    public function index()
    {
        if(!isset($_SESSION['admin_true'])){
            $this->view('/auth/login');
        } else {
            header("Location: " . BASE_URL . "/admin");
            exit;
        }
    }

    public function login()
    {
        $data = [
            'name' => $this->request->input('name'),
            'password' => $this->request->input('pass')
        ];

        $result = $this->modelAdmin->checkUser($data);

        if($result && \password_verify($data['password'],$result['password'])){
            $_SESSION['admin_true'] = $result['nome'];
            header("Location: " . BASE_URL . "/admin");
            exit;
        } else {
            header("Location: " . BASE_URL . "/error404");
            exit;
        }
    }


}