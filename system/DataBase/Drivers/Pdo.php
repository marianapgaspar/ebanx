<?php
namespace System\DataBase\Drivers;
use System\DataBase\Entities\Result;
class Pdo extends ADriver{
    public function __construct(\System\Configs\DataBase $config)
    {
        parent::__construct($config);
    }
    function connect():self{
        try {
        $this->connection =  new \PDO("mysql:host={$this->config->getHost()};dbname={$this->config->getDatabase()}", $this->config->getUser(),$this->config->getPassword());
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \System\Exceptions\SqlConnectionException($e->getMessage(),$e->getCode());
        }

        return $this;
    }

    function query(string $query):self{
        $this->query = $query;
        return $this;
    }
    function escape(string $string):string{
        return $this->connection->real_escape_string($string);
    }
    function execute():Result{
        $result =  $this->connection->query($this->query);
        if (!$result) {
            throw new \System\Exceptions\SqlException((string)$this->connection->error,(string)$this->connection->errno,$this->query);
        }
        $data = [];
        if($result===true){
            return new Result(0,[]);
        }
        if($result){
            foreach($result as $row) {
                $data[] = (object)$row;
            }
        }
        
        $resultObject =  new Result(count($data),$data);
        return $resultObject;
    }
    function disconnect():void{
    }
}