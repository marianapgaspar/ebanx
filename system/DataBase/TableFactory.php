<?php
namespace System\DataBase;

use Exception;
use System\Configs\DataBase;
use System\DataBase\Builders\Table\ABuilder;
use System\DataBase\Builders\Table\Mysql;
use System\DataBase\Drivers\ADriver;
use System\DataBase\Drivers\Mysqli;
use System\DataBase\Drivers\Pdo;
use System\DataBase\Entities\Column;
use System\DataBase\Entities\Table;

class TableFactory extends Table{

    private ADriver $driver;
    private ABuilder $builder;
    public function __construct(ADriver $driver,ABuilder $builder, string $name)
    {
        parent::__construct($name);
        $this->driver = $driver;
        $this->builder = $builder;
    }

    public function create():void{
        $this->driver->query($this->builder->create($this))->execute();
        $this->modifyTable();
    }
    private function dropKeys(){
        $result = $this->driver->query("SELECT * FROM information_schema.KEY_COLUMN_USAGE 
        WHERE KEY_COLUMN_USAGE.CONSTRAINT_SCHEMA = '".APP_DB_NAME."' AND KEY_COLUMN_USAGE.TABLE_NAME = '{$this->name}'")->execute()->rows();
        try{
            $this->driver->query("ALTER TABLE `{$this->name}`
            DROP PRIMARY KEY")->execute();
        }catch(Exception $e){
            return $e->getMessage().PHP_EOL;
        }
       
        foreach($result as $row){
            if($row->CONSTRAINT_NAME=='PRIMARY'){
                continue;
            }
            if($row->REFERENCED_TABLE_NAME){
                try{
                    $this->driver->query("ALTER TABLE {$this->name} DROP FOREIGN KEY {$row->CONSTRAINT_NAME};")->execute();
                }catch(Exception $e){
                    return $e->getMessage().PHP_EOL;
                }
            }
            try{
                $this->driver->query("ALTER TABLE `{$this->name}`
                DROP INDEX `{$row->CONSTRAINT_NAME}`")->execute();
            }catch(Exception $e){
                return $e->getMessage().PHP_EOL;
            }
        }
    }

    private function createKeys(){
        try{
            foreach($this->primaryKeys as $primaryKey){
                $this->driver->query("ALTER TABLE `{$this->name}`
                ADD PRIMARY KEY ($primaryKey)")->execute();
            }
        
            $indexKey = 0;
            foreach($this->getIndexes() as $index){
                $verify = $this->driver->query("SHOW indexes FROM ".APP_DB_NAME.".{$this->name} WHERE Key_name = 'INDEX_".$indexKey."'")->execute()->rows();
                if (!empty($verify)){
                    $this->driver->query("ALTER TABLE {$this->name} DROP INDEX `INDEX_".$indexKey."`;")->execute();
                }
                $this->driver->query("ALTER TABLE `{$this->name}`
                ADD INDEX `INDEX_".$indexKey."` ($index)")->execute();
                $indexKey++;
            }
        
            $uniqueKey = 0;
            foreach($this->uniqueKeys as $index){
                $this->driver->query("ALTER TABLE `{$this->name}`
                ADD UNIQUE KEY `UNIQUE_". $uniqueKey."` ($index)")->execute();
                
                $uniqueKey++;
            }
        
            $foreignKey = 0;
            foreach($this->foreignKeys as $foreign){ 
                $this->driver->query("ALTER TABLE `$this->name`
                ADD CONSTRAINT `FOREIGN_{$foreignKey}` FOREIGN KEY (`{$foreign['column']}`) REFERENCES `{$foreign['refTable']}` (`{$foreign['key']}`) ON UPDATE NO ACTION ON DELETE NO ACTION")->execute();
                $foreignKey++;
            }
        }catch(Exception $e){
            echo $e->getMessage().PHP_EOL;
        }
    }

    private function modifyTable(){
        $result = $this->driver->query("SELECT *
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = '".APP_DB_NAME."' AND TABLE_NAME = '{$this->name}'")->execute();
        
        $this->driver->query('SET foreign_key_checks = 0')->execute();
        $tableFields = array_map(function($data){return $data->COLUMN_NAME;},$result->rows());
        $tableTypes = array_map(
            function($data){
                $size = $data->CHARACTER_MAXIMUM_LENGTH;
                if($data->NUMERIC_PRECISION){
                    $size = $data->NUMERIC_PRECISION;
                }
                if($data->NUMERIC_SCALE){
                    $size .= ','.$data->NUMERIC_SCALE;
                }
                return ['type'=>strtoupper($data->DATA_TYPE),'size'=> $size,'nullable'=>$data->IS_NULLABLE,'default'=>$data->COLUMN_DEFAULT=='YES'];
            },
            $result->rows());
        $after = null;
        
        foreach($result->rows() as $field){
            if($field->EXTRA=='auto_increment'){
                $column = (new Column($field->COLUMN_NAME,'INT'))->size($field->NUMERIC_PRECISION);
                $this->driver->query($this->builder->updateColumnFromTable($this->name,$column))->execute();
            }
        }
        
        $this->dropKeys();
        
        foreach($this->columns as $column){
            $columnClone = clone $column;
            $columnClone->autoincrement(false);
            if(!in_array($columnClone->getName(),$tableFields)){
                $this->driver->query($this->builder->addColumnToTable($this->name,$columnClone,$after))->execute();
                $after = $columnClone->getName();
                continue;
            }
            $this->driver->query($this->builder->updateColumnFromTable($this->name,$columnClone,$after))->execute();
            $after = $columnClone->getName();
            unset($tableFields[array_search($columnClone->getName(),$tableFields)]);
        }
        
        foreach($tableFields as $field){
            $this->driver->query($this->builder->dropColumnFromTable($this->name,$field))->execute();
        }
        
        $this->createKeys();
        
        foreach($this->columns as $column){
            if($column->getAutoincrement()){
                $this->driver->query($this->builder->updateColumnFromTable($this->name,$column))->execute();
            }
        }
        
        $this->driver->query('SET foreign_key_checks = 1')->execute();
    }
    
    public static function mysqli(string $name,DataBase $config = null):TableFactory{
        if($config === null){
            $config = DataBase::default();
        }
        $driver = new Pdo($config);
        $builder = new Mysql();
        return new TableFactory($driver,$builder,$name);
    }
    public static function instance(string $name,DataBase $config = null):TableFactory{
        if($config === null){
            $config = DataBase::default();
        }
        $driverNamespace = "System\DataBase\Drivers\\".APP_DB_DRIVE;
        $driver = new $driverNamespace($config);
        $builder = new MySql();
        return new TableFactory($driver,$builder,$name);
    }
}