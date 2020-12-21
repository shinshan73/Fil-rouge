<?php
namespace Core;

class Database{

    public $pdo;
    private $host;
    private $login;
    private $pass;
    private $options;

    function __construct()
    {   
        try {
            require "Config/Config.php";
            $this->host = $dbconfig["host"];
            $this->login = $dbconfig["login"];
            $this->pass = $dbconfig["pass"];
            $this->options = $dbconfig["options"];
            $this->pdo = new \PDO ($this->host, $this->login, $this->pass, $this->options);

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function query(string $statement, bool $one = false)
    {
        $query = $this->pdo->query($statement);
        if ($one) {
            return $query->fetch(\PDO::FETCH_OBJ);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    public function prepare(string $statement, $data = array())
    {
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
    }
}