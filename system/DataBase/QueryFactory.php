<?php
namespace System\DataBase;

use System\Configs\DataBase;
use System\DataBase\Builders\Query\ABuilder;
use System\DataBase\Builders\Query\MySql;
use System\DataBase\Drivers\ADriver;
use System\DataBase\Drivers\Mysqli;
use System\DataBase\Entities\Result;
use System\DataBase\Entities\Select;

class QueryFactory extends Select{
    protected ADriver $driver;
    protected ABuilder $builder;

    public function __construct(ADriver $driver, ABuilder $builder)
    {
        $this->driver = $driver;
        $this->builder = $builder;
    }
    public function compileSelect():string{
        return $this->builder->select($this);
    }
    public function compileDelete(array $tables):string{
        return $this->builder->delete($this,$tables);
    }
    public function compileInsert(string $table, array $tables):string{
        return $this->builder->insert($table,$tables);
    }
    public function compileUpdate(array $values,bool $quotes = true):string{
        return $this->builder->update($this,$values,$quotes);
    }
    public function get():Result{
        return $this->driver->query($this->compileSelect())->execute();
    }

    public static function mysqli(DataBase $config = null):QueryFactory{
        if($config === null){
            $config = DataBase::default();
        }
        $driver = new Mysqli($config);
        $builder = new MySql();
        
        return new QueryFactory($driver,$builder);
    }
    public static function instance(DataBase $config = null):QueryFactory{
        if($config === null){
            $config = DataBase::default();
        }
        $driverNamespace = "System\DataBase\Drivers\\".APP_DB_DRIVE;
        $driver = new $driverNamespace($config);
        $builder = new MySql();
        return new QueryFactory($driver,$builder);
    }
    public function lastQuery():string{
        return $this->driver->getQuery();
    }

    public function getEscape(string $string):string{
        return $this->driver->escape($string);
    }

    public function query(string $query):Result{
        $this->driver->query($query);
        return $this->driver->execute();
    }

    public function delete(array $tables):void{
        $this->driver->query($this->compileDelete($tables))->execute();
    }
    public function update(array $values,bool $quotes = true){
        $this->driver->query($this->compileUpdate($values,$quotes))->execute();
    }
    public function insert(string $table, array $tables){
        
        $this->driver->query($this->compileInsert($table, $tables))->execute();
    }
    public function getBuilder():ABuilder{
        return $this->builder;
    }
}