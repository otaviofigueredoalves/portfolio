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

        $webapp = [];
        $webpage = [];
        
        foreach($dados_projects as $dado){
            if($dado->category == 'webapp'){
                $webapp[] = $dado;
            } else if($dado->category == 'webpage'){
                $webpage[] = $dado;
            }
        }

        $this->view('home',[
            'webapp' => $webapp,
            'webpage' => $webpage,
            'techs' => $dados_tech
        ]);   
    }
    
}