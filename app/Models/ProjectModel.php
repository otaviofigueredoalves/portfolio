<?php

namespace App\Models;

use App\Core\Model;
use PDOException;

class ProjectModel extends Model
{
    private $domain;
    public $id;
    public $nome;
    public $descricao;
    public $url_github_project = NULL;
    public $project_img;
    public $img_alt;
    public $site_link = NULL;
    public $tech_list = [];
    public $category;

    public function __construct()
    {
        parent::__construct();
        $this->domain = config('domain');
    }
    public function getAllProjects()
    {
        $sql = "SELECT 
        projects.id AS project_id,
        projects.nome,
        projects.descricao,
        projects.url_github_project,
        projects.project_img,
        projects.img_alt,
        projects.site_link,
        projects.category,
        technologies.id AS tech_id,
        technologies.nome AS tech_nome
        FROM projects
        LEFT JOIN project_technologies ON projects.id = project_technologies.project_id
        LEFT JOIN technologies ON project_technologies.technology_id = technologies.id";

        $dados = $this->db->fetchAll($sql);

        $projects = [];

        foreach($dados as $project){
            $project_id = $project['project_id'];

            if(!isset($projects[$project_id])){
                $projectObj = new ProjectModel;
                $projectObj->id = $project['project_id'];
                $projectObj->nome = $project['nome'];
                $projectObj->descricao = $project['descricao'];
                $projectObj->url_github_project = $project['url_github_project'];
                $projectObj->project_img = $project['project_img'];
                $projectObj->img_alt = $project['img_alt'];
                $projectObj->site_link = $project['site_link'];
                $projectObj->category = $project['category'];
                $projects[$project_id] = $projectObj;
            }

            if($project['tech_id']){
                $projects[$project_id]->tech_list[] = [
                    'id' => $project['tech_id'],
                    'nome' => $project['tech_nome']
                ];
            }
            // dd($project,$projects,$project_id);
        }

        return array_values($projects);
    }

    public function getAllTechs()
    {
        $sql = "SELECT * FROM technologies";

        $data = $this->db->fetchAll($sql);

        return $data;


    }
}
