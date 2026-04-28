<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProjectModel;
use Exception;

class AdminController extends Controller
{
    private $model;
    private $techs;
    public function __construct()
    {
        $this->model = new ProjectModel();
        $this->techs = $this->model->getAllTechs();
    }
    public function index()
    {
        if(!isset($_SESSION['admin_true'])){
            $this->redirect('/');
            exit;
        }

        $techs = [
            'techs' => $this->techs
        ];

        $projects = $this->listProjects();

        $data = [
            'techs' => $techs,
            'projects' => $projects
        ];
        
        $this->view('/auth/header');
        $this->view('/auth/admin',$data);
    }

    public function new()
    {

        $data = [
            'name_action' => 'Criar',
            'action' => 'create',
            'techs' => $this->techs
        ];

        $this->view('/auth/header');
        $this->view('/auth/project',$data);
        exit;
    }

    public function create()
    {
        $project_content = $this->getProjectContent();
        $this->model->setProject($project_content);
        $this->redirect('/admin');
    }

    public function drop(int $id)
    {
        $this->model->deleteProject($id);
        $this->redirect('/admin');
    }

    public function listProjects()
    {
        $projects = $this->model->getAllProjects();
        return $projects;
    }

    public function edit(int $id)
    {
        $project = $this->model->getProjectById($id);
        $techs = $this->techs;
        $data = [
            'name_action' => 'Editar',
            'action' => 'edit',
            'project' => $project,
            'techs' => $techs
        ];
        $this->view('/auth/header');
        $this->view('/auth/project',$data);
    }

    public function update(int $id)
    {
        
        $project_content = $this->getProjectContent($id);
        $this->model->updateProject($project_content);
        $this->redirect('/admin');
    }

    private function getProjectContent(?int $id = null) : array
    {
        $img_file = $this->request->files->get('project_img');
        $img_banco = $this->request->request->get('current_img');

        if($img_file && $img_file->isValid()){
            $originalName = pathinfo($img_file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $img_file->guessExtension();
            $img_banco = 'projeto_' . $originalName . '_' . \uniqid() . '.' . $extension;
            $path = __DIR__ . '/../../public/assets/images/projects_img/';
            $img_file->move($path, $img_banco);
        }
        $project_content = [
            'nome' => $this->request->request->get('nome'),
            'descricao' => $this->request->request->get('descricao'),
            'github' => $this->request->request->get('url_github_project'),
            'project_img' => $img_banco,
            'img_alt' => $this->request->request->get('img_alt'),
            'site_link' => $this->request->request->get('site_link'),
            'category' => $this->request->request->get('category'),
            'techs' => $this->request->request->all('techs'),
            'id' => $id ?? null
        ];

        return $project_content;
    }
}