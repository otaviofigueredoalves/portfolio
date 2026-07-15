<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProjectModel;

class HomeController extends Controller
{

    public function index()
    {
        $model = new ProjectModel();
        $dados_projects = $model->getAllProjects();
        $dados_tech = $model->getAllTechs();

        $categories = $model->getAllCategories();

        $sections = [];
        
        foreach($categories as $cat) {
            $sections[$cat['id']] = [
                'nome' => $cat['nome'],
                'projects' => []
            ];
        }

        foreach($dados_projects as $dado){
            $cat_id = $dado->category;
            if (isset($sections[$cat_id])) {
                $sections[$cat_id]['projects'][] = $dado;
            }
        }

        $this->view('home',[
            'sections' => $sections,
            'techs' => $dados_tech
        ]);   
    }
    
}