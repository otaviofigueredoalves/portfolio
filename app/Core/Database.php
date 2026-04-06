<?php
namespace App\Core;

class Database
{
    private $connection = null;
    private $rowCountStmt;
    private static $instance = null;
    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if(empty(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
        
        
    }

    public function connect()
    {
        $configDB = config('database');
        $host = $configDB['host'];
        $dbname = $configDB['dbname'];
        $charset = $configDB['charset'];
        $username = $configDB['user'];
        $password = $configDB['pass'];
        
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try{
            $this->connection = new \PDO($dsn, $username, $password, $options);
            return;
        } catch (\PDOException $e){
            throw new \Exception("Erro de conexão ao DB: ". $e->getMessage());
        }
        return;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            $this->rowCountStmt = $stmt;
            return $stmt;
        } catch (\PDOException $e){
            throw new \Exception("Erro ao consultar o DB: ". $e->getMessage());
        }
    }

    public function fetch($sql, $params = []): ?array
    {
        $stmt = $this->query($sql,$params);
        $result = $stmt->fetch();
        return $result?:null;
    }
    public function fetchAll($sql, $params = []):array
    {
        $stmt = $this->query($sql,$params);
        return $stmt->fetchAll();
    }
    public function execute($sql, $params = []) : int
    {
        $stmt = $this->query($sql,$params);
        return $stmt->rowCount();
    }
    public function lastInsertId() : int
    {
        return $this->connection->lastInsertId();
    }
    public function rowCount() : int
    {
        return $this->rowCountStmt ? $this->rowCountStmt->rowCount() : 0;
    }

}