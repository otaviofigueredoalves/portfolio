<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProjectModel;
use Exception;

class AdminController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new ProjectModel();
    }
    public function index()
    {
        if(!isset($_SESSION['admin_true'])){
            $this->redirect('/');
            exit;
        }

        $techs = [
            'techs' => $this->model->getAllTechs()
        ];
        
        $this->view('/auth/admin',$techs);
    }

    public function register()
    {
        $img_file = $this->request->files->get('project_img');
        $img_banco = '';

        if($img_file && $img_file->isValid()){
            $extension = $img_file->guessExtension();
            $img_banco = \uniqid('projeto_') . '.' . $extension;
            $path = __DIR__ . '/../../public/assets/images/projects_img/';
            $img_file->move($path, $img_banco);
        } else {
            throw new Exception("Você precisa enviar uma imagem válida");
        }
        $project_content = [
            'nome' => $this->request->request->get('nome'),
            'descricao' => $this->request->request->get('descricao'),
            'github' => $this->request->request->get('url_github_project'),
            'project_img' => $img_banco,
            'img_alt' => $this->request->request->get('img_alt'),
            'site_link' => $this->request->request->get('site_link'),
            'category' => $this->request->request->get('category'),
            'techs' => $this->request->request->get('techs')
        ];

        $this->model->setProject($project_content);
        $this->redirect('/admin');
        exit;
    }
}