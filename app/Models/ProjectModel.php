<?php

namespace App\Models;

use App\Core\Model;

class ProjectModel extends Model
{
    public int $id;
    public string $nome;
    public string $descricao;
    public string $url_github_project = '';
    public string $project_img;
    public string $img_alt;
    public string $site_link = '';
    public array $tech_list = [];
    public string $category;
    public ?string $highlight_tag = null;
    public int $sort_by;

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
        projects.highlight_tag,
        projects.sort_by,
        technologies.id AS tech_id,
        technologies.nome AS tech_nome
        FROM projects
        LEFT JOIN project_technologies ON projects.id = project_technologies.project_id
        LEFT JOIN technologies ON project_technologies.technology_id = technologies.id
        ORDER BY projects.sort_by ASC, projects.id DESC";

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
                $projectObj->highlight_tag = $project['highlight_tag'];
                $projectObj->sort_by = $project['sort_by'];
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

    public function setTech(string $nome, string $icon)
    {
        $sql = "INSERT INTO technologies (nome, icon) VALUES(:nome, :icon)";
        $params = [
            'nome' => $nome,
            'icon' => $icon
        ];
        $this->db->execute($sql, $params);
    }

    public function setProject(array $content)
    {
        $sql = "INSERT INTO projects 
        (nome,descricao,url_github_project,project_img,img_alt,site_link,category,highlight_tag,sort_by) VALUES(
        :nome, :descricao, :github, :project_img, :img_alt, :site_link, :category, :highlight_tag, :sort_by
        )";

        $params = [
            'nome' => $content['nome'],
            'descricao' => $content['descricao'],
            'github' => $content['github'],
            'project_img' => $content['project_img'],
            'img_alt' => $content['img_alt'],
            'site_link' => $content['site_link'],
            'category' => $content['category'],
            'highlight_tag' => empty($content['highlight_tag']) ? null : $content['highlight_tag'],
            'sort_by' => $content['sort_by']
        ];

        $this->db->query($sql, $params);
        $id_projeto = $this->db->lastInsertId();

        $sql = "INSERT INTO project_technologies (project_id, technology_id) VALUES(:project_id, :technology_id)";
        foreach((array)($content['techs'] ?? []) as $tech){
            $params_aux = [
                'project_id' => $id_projeto,
                'technology_id' => $tech
            ];
            $this->db->query($sql,$params_aux);
        }
    }

    public function updateProject(array $content)
    {
        $sql_d = "DELETE FROM project_technologies WHERE project_id = :id";
        $params = [ 
            'id' => $content['id']
        ];

        $this->db->query($sql_d, $params);
        
        $sql_upd = "UPDATE projects SET
        nome = :nome,
        descricao = :descricao,
        url_github_project = :github,
        project_img = :project_img,
        img_alt = :img_alt,
        site_link = :site_link,
        category = :category,
        highlight_tag = :highlight_tag,
        sort_by = :sort_by
        WHERE id=:id
        ";

        $params_upd = [
            'nome' => $content['nome'],
            'descricao' => $content['descricao'],
            'github' => $content['github'],
            'project_img' => $content['project_img'],
            'img_alt' => $content['img_alt'],
            'site_link' => $content['site_link'],
            'category' => $content['category'],
            'highlight_tag' => empty($content['highlight_tag']) ? null : $content['highlight_tag'],
            'id' => $content['id'],
            'sort_by' => $content['sort_by'],
        ];

        $this->db->query($sql_upd, $params_upd);

        $sql = "INSERT INTO project_technologies (project_id, technology_id) VALUES(:project_id, :technology_id)";
        foreach((array)($content['techs'] ?? []) as $tech){
            $params_techs = [
                'project_id' => $content['id'],
                'technology_id' => $tech
            ];
            $this->db->query($sql,$params_techs);
        }        
    }

    public function deleteProject(int $id) : void 
    {
        $sql_d = "DELETE FROM project_technologies WHERE project_id = :id";
        $params = [
            'id' => $id
        ];
        $this->db->query($sql_d, $params);

        $sql = "DELETE FROM projects WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $this->db->query($sql, $params);
    }

    public function getProjectById(int $id)
    {
        $sql = "SELECT 
        projects.id,
        projects.nome,
        projects.descricao,
        projects.url_github_project,
        projects.project_img,
        projects.img_alt,projects.site_link,
        projects.category,
        projects.highlight_tag,
        projects.sort_by,
        technologies.id AS tech_id,
        technologies.nome AS tech_nome
        FROM projects 
        LEFT JOIN project_technologies ON projects.id = project_technologies.project_id
        LEFT JOIN technologies ON technology_id = technologies.id
        WHERE projects.id=:id"
        ;

        $params = [
            'id' => $id
        ];

        $dados = $this->db->fetchAll($sql, $params);
        $project_mount = [];

        foreach($dados as $project){
            $project_id = $project['id'];
            if(!isset($project_mount[$project_id])){
                $project_mount[$project_id] = $this->buildProjectObject($project);
            }
            
            if($project['tech_id']){
                $project_mount[$project_id]->tech_list[] = [
                    'id' => $project['tech_id'],
                    'nome' => $project['tech_nome']
                ];
            }

        }     
        $project_mount = array_values($project_mount);
        return $project_mount[0];
    }

    private function buildProjectObject(array $project)
    {
        $projectObj = new ProjectModel;
                $projectObj->id = $project['id'];
                $projectObj->nome = $project['nome'];
                $projectObj->descricao = $project['descricao'];
                $projectObj->url_github_project = $project['url_github_project'];
                $projectObj->project_img = $project['project_img'];
                $projectObj->img_alt = $project['img_alt'];
                $projectObj->site_link = $project['site_link'];
                $projectObj->category = $project['category'];
                $projectObj->highlight_tag = $project['highlight_tag'];
        $projectObj->sort_by = $project['sort_by'];
        return $projectObj;
    }

    // --- TECHNOLOGIES CRUD COMPLEMENT ---
    public function getTechById(int $id)
    {
        $sql = "SELECT * FROM technologies WHERE id = :id";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function updateTech(int $id, string $nome, string $icon = '')
    {
        if ($icon) {
            $sql = "UPDATE technologies SET nome = :nome, icon = :icon WHERE id = :id";
            $this->db->execute($sql, ['id' => $id, 'nome' => $nome, 'icon' => $icon]);
        } else {
            $sql = "UPDATE technologies SET nome = :nome WHERE id = :id";
            $this->db->execute($sql, ['id' => $id, 'nome' => $nome]);
        }
    }

    public function deleteTech(int $id)
    {
        $this->db->execute("DELETE FROM project_technologies WHERE technology_id = :id", ['id' => $id]);
        $this->db->execute("DELETE FROM technologies WHERE id = :id", ['id' => $id]);
    }

    // --- CATEGORIES (SECTIONS) CRUD ---
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->fetchAll($sql);
    }

    public function getCategoryById(int $id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function setCategory(string $nome)
    {
        $sql = "INSERT INTO categories (nome) VALUES (:nome)";
        $this->db->execute($sql, ['nome' => $nome]);
    }

    public function updateCategory(int $id, string $nome)
    {
        $sql = "UPDATE categories SET nome = :nome WHERE id = :id";
        $this->db->execute($sql, ['id' => $id, 'nome' => $nome]);
    }

    public function deleteCategory(int $id)
    {
        $this->db->execute("UPDATE projects SET category = NULL WHERE category = :id", ['id' => $id]);
        $this->db->execute("DELETE FROM categories WHERE id = :id", ['id' => $id]);
    }
}
