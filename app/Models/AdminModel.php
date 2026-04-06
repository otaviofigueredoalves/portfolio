<?php
namespace App\Models;

use App\Core\Model;

class AdminModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function checkUser($data)
    {
        $sql = "SELECT * FROM admin WHERE nome = :name";
        $params = [
            'name' => $data['name']
        ];
        
        $result = $this->db->fetch($sql, $params);
        
        return $result;
    }
}
