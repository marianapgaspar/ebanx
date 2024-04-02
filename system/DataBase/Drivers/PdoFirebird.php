<?php
namespace System\DataBase\Drivers;
use System\DataBase\Entities\Result;
class PdoFirebird{
    protected string $query;
    public \PDO|null $connection;
    public function __construct()
    {
        $this->connect();
    }
    function connect():self{
        try {
            $this->connection =  new \PDO("firebird:dbname=".ERP_DB_HOST.";charset=UTF8", ERP_DB_USER, ERP_DB_PASSWORD);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \System\Exceptions\SqlConnectionException($e->getMessage());
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
    function results():array{
        try {
            $stmt = $this->connection->query($this->query);
            if (!$stmt) {
                throw new \System\Exceptions\SqlException((string)$this->connection->error,(string)$this->connection->errno,$this->query);
            }
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $temp = [];
            foreach($results as $numberLine=>$line){
                foreach ($line as $key => $value){
                    if (!$value){
                        $temp[$numberLine][$key] = $value;
                        continue;
                    }
                    $temp[$numberLine][$key] = mb_convert_encoding($value, 'UTF-8');
                }
            }
            return $results;
        } catch(\PDOException $e) {
            echo $e->getMessage();
            echo $e->getCode();
        }
        return [];
    }
    function __destruct(){
        $this->connection = null;
    }
}