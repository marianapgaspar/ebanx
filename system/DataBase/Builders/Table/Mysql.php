<?php
namespace System\DataBase\Builders\Table;

use System\DataBase\Entities\Column;
use System\DataBase\Entities\Table;

class Mysql extends ABuilder{
    function create(Table $table):string{

        $tableSql = "CREATE TABLE IF NOT EXISTS {$table->getName()} (";
        foreach($table->getColumns() as $column){
            $tableSql .= "{$this->_createColumn($column)},";
        }
        if($table->getIndexes()){
            foreach($table->getIndexes() as $index){
                $tableSql .= "INDEX ({$index}),";
            }
        }
        if($table->getPrimaryKeys()){
             $tableSql .= "PRIMARY KEY (".implode(',',$table->getPrimaryKeys())."),";
        }
        if($table->getUniqueKeys()){
            foreach($table->getUniqueKeys() as $chaveUnica){
                $tableSql .= "UNIQUE KEY ({$chaveUnica}),";
            }
        }
        if($table->getForeignKeys()){
            foreach($table->getForeignKeys() as $chaveEstrangeira){
                $tableSql .= "FOREIGN KEY ({$chaveEstrangeira["column"]}) REFERENCES {$chaveEstrangeira['refTable']}({$chaveEstrangeira['key']}),";
            }
        }
        $tableSql =trim($tableSql,',');
        $tableSql .=")";
        return $tableSql;
    }
    function dropTable(Table $table):string{
        return "";
    }

    function dropColumn(Table $table):string{
        return "";
    }
    function addColumn(Table $table):string{
        return "";
    }

    function modifyColumn(Table $table, Column $column,Column $newColumn){
        return "";
    }
    private function _createColumn(Column $column){
        $columnSql = "";
        $columnSql .= $column->getName()." ";
        $columnSql .= $column->getType();
        if($column->getSize()){
            $columnSql .= "({$column->getSize()})";
        }
         if($column->getAutoincrement()){
            $columnSql .= " AUTO_INCREMENT";
        }
        if(!$column->getNull()){
             $columnSql .= " NOT NULL";
        }else{
             $columnSql .= " NULL";
        }
       
        if($column->getDefaultValue()!==null){
            $columnSql .= " DEFAULT {$column->getDefaultValue()}";
        }
        return $columnSql;
    }

    public function addColumnToTable(string $table,Column $column,string|null $after = null):string{
        return "ALTER TABLE `$table`
        ADD COLUMN ".$this->_createColumn($column).($after?" AFTER `$after`":"");
    }

    public function updateColumnFromTable(string $table,Column $column,string|null $after = null):string{
        return "ALTER TABLE `$table`
        CHANGE COLUMN {$column->getName()} ".$this->_createColumn($column).($after?" AFTER `$after`":"");
    }
    public function dropColumnFromTable(string $table,string $column):string{
        return "ALTER TABLE `$table`
        DROP COLUMN `$column`;";
    }
}