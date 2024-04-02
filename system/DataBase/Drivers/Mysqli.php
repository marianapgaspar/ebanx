<?php
namespace System\DataBase\Drivers;
use System\DataBase\Entities\Result;
class Mysqli extends ADriver{

    private \mysqli $connection;


    public function __construct(\System\Configs\DataBase $config)
    {
        parent::__construct($config);
    }
    function connect():self{
        $this->connection = new \mysqli($this->config->getHost(),$this->config->getUser(),$this->config->getPassword(),$this->config->getDatabase());
        if ($this->connection->connect_errno) {
            throw new \System\Exceptions\SqlConnectionException($this->connection->connect_error,$this->connection->connect_errno);
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
            while ($row =$result->fetch_assoc() ) {
                $data[] = (object)$row;
            }
        }
        
        $resultObject =  new Result($result->num_rows,$data);
        $result->free();
        return $resultObject;
    }
    function disconnect():void{
        $this->connection->close();
    }
}
