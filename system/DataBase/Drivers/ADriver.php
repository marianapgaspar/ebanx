<?php declare(strict_types=1);
namespace System\DataBase\Drivers;

use System\Configs\DataBase;
use System\DataBase\Entities\Result;

abstract class ADriver{

    protected \System\Configs\DataBase $config;
    protected string $query = "";

    public function __construct(\System\Configs\DataBase $config)
    {
        $this->config = $config;
        $this->connect();
    }
    abstract function connect():self;
    abstract function query(string $query):self;
    abstract function execute():Result;
    abstract function escape(string $string):string;
    abstract function disconnect():void;
    public function getQuery():string{
        return $this->query;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}