<?php
namespace App\Controllers;

use App\Controllers\errors\HttpErrorsController;
use App\Core\Controller;
use App\Core\Request;
use App\Models\ProjectModel;

class AdminController extends Controller
{
    private $model;
    private $request;
    public function __construct()
    {
        $this->model = new ProjectModel();
        $this->request = new Request();
    }
    public function index()
    {
        if(!isset($_SESSION['admin_true'])){
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $techs = [
            'techs' => $this->model->getAllTechs()
        ];
        
        $this->view('/auth/admin',$techs);
    }

    public function register()
    {
        $img_name = $this->request->getImage();
        
        $project_content = [
            'nome' => $this->request->input('nome'),
            'descricao' => $this->request->input('descricao'),
            'github' => $this->request->input('url_github_project'),
            'project_img' => $img_name,
            'img_alt' => $this->request->input('img_alt'),
            'site_link' => $this->request->input('site_link'),
            'category' => $this->request->input('category'),
            'techs' => $this->request->input('techs')
        ];

        $this->model->setProject($project_content);
        header("Location: " . BASE_URL . "/admin");
        exit;
    }
}