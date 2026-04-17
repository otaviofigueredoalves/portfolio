<?php

namespace App\Models;

use App\Core\Model;

class ProjectModel extends Model
{
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
        }

        return array_values($projects);
    }

    public function getAllTechs()
    {
        $sql = "SELECT * FROM technologies";
        $data = $this->db->fetchAll($sql);
        return $data;
    }

    public function setProject(array $content)
    {
        $sql = "INSERT INTO projects 
        (nome,descricao,url_github_project,project_img,img_alt,site_link,category) VALUES(
        :nome, :descricao, :github, :project_img, :img_alt, :site_link, :category
        )";

        $params = [
            'nome' => $content['nome'],
            'descricao' => $content['descricao'],
            'github' => $content['github'],
            'project_img' => $content['project_img'],
            'img_alt' => $content['img_alt'],
            'site_link' => $content['site_link'],
            'category' => $content['category'],
        ];

        $this->db->query($sql, $params);
        $id_projeto = $this->db->lastInsertId();

        $sql = "INSERT INTO project_technologies (project_id, technology_id) VALUES(:project_id, :technology_id)";

        foreach($content['techs'] as $tech){
            $params_aux = [
                'project_id' => $id_projeto,
                'technology_id' => $tech
            ];
            $this->db->query($sql,$params_aux);
        }
    }
}
