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
        if(!isset($_SESSION['guest']) && !isset($_SESSION['admin_true'])){
            $this->redirect('/');
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
            'techs' => $this->techs,
            'categories' => $this->model->getAllCategories()
        ];

        $this->view('/auth/header');
        $this->view('/auth/project',$data);
        exit;
    }

    public function create()
    {
        $this->checkGuest();
        $project_content = $this->getProjectContent();
        $this->model->setProject($project_content);
        $this->redirect('/admin');
    }

    public function newTech()
    {
        $this->view('/auth/header');
        $this->view('/auth/tech', []);
    }

    public function createTech()
    {
        $this->checkGuest();
        $nome = $this->request->request->get('nome');
        $img_file = $this->request->files->get('tech_icon');

        if ($img_file && $img_file->isValid()) {
            $originalName = pathinfo($img_file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $img_file->guessExtension();
            // Para tecnologias o ideal é manter o nome simples, mas vamos garantir que não haja conflitos
            $img_banco = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName) . '_' . \uniqid() . '.' . $extension;
            $path = __DIR__ . '/../../public/assets/icons/';
            $img_file->move($path, $img_banco);

            $this->model->setTech($nome, $img_banco);
        }
        
        $this->redirect('/admin');
    }

    public function drop(int $id)
    {
        $this->checkGuest();
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
            'action' => 'update',
            'project' => $project,
            'techs' => $techs,
            'categories' => $this->model->getAllCategories()
        ];
        $this->view('/auth/header');
        $this->view('/auth/project',$data);
    }

    public function update(int $id)
    {
        $this->checkGuest();
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
            'highlight_tag' => $this->request->request->get('highlight_tag'),
            'techs' => $this->request->request->all()['techs'] ?? [],
            'id' => $id ?? null,
            'sort_by' => $this->request->request->get('sort_by')
        ];

        return $project_content;
    }

    private function checkGuest()
    {
        if(isset($_SESSION['guest'])){
            throw new Exception("Você não tem permissão pra criar um projeto!");
        }
    }

    // --- TECHNOLOGIES ROUTES ---
    public function techs()
    {
        $data = ['techs' => $this->model->getAllTechs()];
        $this->view('/auth/header');
        $this->view('/auth/techs', $data);
    }

    public function editTech(int $id)
    {
        $tech = $this->model->getTechById($id);
        $data = ['tech' => $tech];
        $this->view('/auth/header');
        $this->view('/auth/tech', $data);
    }

    public function updateTech(int $id)
    {
        $this->checkGuest();
        $nome = $this->request->request->get('nome');
        $img_file = $this->request->files->get('tech_icon');
        $img_banco = '';

        if ($img_file && $img_file->isValid()) {
            $originalName = pathinfo($img_file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $img_file->guessExtension();
            $img_banco = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName) . '_' . \uniqid() . '.' . $extension;
            $path = __DIR__ . '/../../public/assets/icons/';
            $img_file->move($path, $img_banco);
        }

        $this->model->updateTech($id, $nome, $img_banco);
        $this->redirect('/admin/techs');
    }

    public function dropTech(int $id)
    {
        $this->checkGuest();
        $this->model->deleteTech($id);
        $this->redirect('/admin/techs');
    }

    // --- SECTIONS (CATEGORIES) ROUTES ---
    public function sections()
    {
        $data = ['categories' => $this->model->getAllCategories()];
        $this->view('/auth/header');
        $this->view('/auth/sections', $data);
    }

    public function newSection()
    {
        $this->view('/auth/header');
        $this->view('/auth/section_form', []);
    }

    public function createSection()
    {
        $this->checkGuest();
        $nome = $this->request->request->get('nome');
        $this->model->setCategory($nome);
        $this->redirect('/admin/sections');
    }

    public function editSection(int $id)
    {
        $category = $this->model->getCategoryById($id);
        $data = ['category' => $category];
        $this->view('/auth/header');
        $this->view('/auth/section_form', $data);
    }

    public function updateSection(int $id)
    {
        $this->checkGuest();
        $nome = $this->request->request->get('nome');
        $this->model->updateCategory($id, $nome);
        $this->redirect('/admin/sections');
    }

    public function dropSection(int $id)
    {
        $this->checkGuest();
        $this->model->deleteCategory($id);
        $this->redirect('/admin/sections');
    }
}