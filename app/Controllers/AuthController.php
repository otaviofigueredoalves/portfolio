<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AdminModel;

class AuthController extends Controller
{
    private $modelAdmin;
    public function __construct()
    {
        $this->modelAdmin = new AdminModel();
    }
    public function index()
    {
        if(!isset($_SESSION['admin_true']) && !isset($_SESSION['guest'])){
            $this->view('/auth/login');
        } else {
            $this->redirect('/admin');
            exit;
        }
    }

    public function login()
    {
        $data = [
            'name' => $this->request->request->get('name'),
            'password' => $this->request->request->get('pass')
        ];

        $result = $this->modelAdmin->checkUser($data);
        if($result && \password_verify($data['password'],$result['password'])){
            if($data['name'] === 'visitante@guest'){
                $_SESSION['guest'] = $result['nome'];
            } else {
                $_SESSION['admin_true'] = $result['nome'];
            }
            session_regenerate_id(true);
            $this->redirect('/admin');
        } else {
            header("Location: " . BASE_URL . "/error404");
            exit;
        }
    }


}