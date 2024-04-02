<?php
namespace System\Models;

use Exception;
use System\DataBase\QueryFactory;

class TableModel extends AModel{

    protected string $table;
    protected QueryFactory $queryFactory;
    protected array $fieldToColumn = [];
    protected array $primaryKeys = [];
    public function __construct(QueryFactory $queryFactory){
        $this->queryFactory = $queryFactory;
        $this->prepare();
    }

    public function query():QueryFactory{
        return $this->queryFactory;
    }

    public function count():int{
        $queryBuilder = clone $this->queryFactory;
        $queryBuilder->clear();
        $queryBuilder->select(['COUNT(1) AS quantity'])
            ->fromSelect($this->queryFactory);
        $result = $queryBuilder->get();

        $row = $result->row();
        return isset($row->quantity)?$row->quantity:0;
    }

    protected function prepare(){
        $this->queryFactory->from($this->table);
        foreach($this->fields as $field){
            if(isset($this->fieldToColumn[$field])){
                $this->queryFactory->select(["{$this->fieldToColumn[$field]} AS $field"]);
                continue;
            }
            $this->queryFactory->select([$field]);
        }
    }

    public function get():self{
        
        $result = $this->queryFactory->get();
        $this->queryFactory->clear();
        $this->prepare();
        $this->setValues((array)$result->row());
        return $this;
    }
    public function result():array{
        $result = $this->queryFactory->get();
        $this->queryFactory->clear();
        $this->prepare();
        $return = [];
        $class = get_called_class();
        foreach($result->rows() as $row){
            $model = new $class($this->queryFactory);
            $model->setValues((array)$row);
            $return[] = $model;
        }
        return $return;
    }
    public function save(){
        try{
            $this->insert();
            return;
        }catch(Exception $e){
            
        }
        foreach($this->primaryKeys as $primaryKey){
          $this->queryFactory->where($primaryKey, '=',$this->getValue($primaryKey));

        }
        $update = [];
        foreach($this->fields as $field){
            if($this->getValue($field)===null){
                continue;
            }
            if(isset($this->fieldToColumn[$field])){
                $update[$this->fieldToColumn[$field]] = $this->getValue($field);
                continue;
            }
            if(in_array($field,$this->protectedFields)){
                $update[$field] = $this->getProtectedValue($field);
                continue;
            }
            $update[$field] = addslashes($this->getValue($field));
        }
        $this->queryFactory->update($update);
        $this->queryFactory->clear();
        $this->prepare();
    }

    public function filter(array $filters):self{
        foreach($this->fields as $field){
            if((!isset($filters[$field])|| !$filters[$field] )){
                continue;
            }
            $data = $filters[$field];
            $column = isset($this->fieldToColumn[$field])?$this->fieldToColumn[$field]:$field;
            if(is_array($data)){
                $this->queryFactory->whereIn($column,$data);
                continue;
            }
            $this->queryFactory->like($column,"%$data%");
        }
        return $this;
    }

    public function insert(){
        $insert = [];
        foreach($this->fields as $field){
            if($this->getValue($field) === null){
                continue;
            }
            if(isset($this->fieldToColumn[$field])){
                if(in_array($field,$this->protectedFields)){
                    $insert[$this->fieldToColumn[$field]] = $this->getProtectedValue($field);
                    continue;
                }
                $insert[$this->fieldToColumn[$field]] = $this->getValue($field);
                continue;
            }
            if(in_array($field,$this->protectedFields)){
                $insert[$field] = $this->getProtectedValue($field);
                continue;
            }
            $insert[$field] = addslashes($this->getValue($field));
        }
        
        $this->queryFactory->insert($this->table,$insert);
        $this->queryFactory->clear();
        $this->prepare();
    }

    public function delete(){
        foreach($this->primaryKeys as $primaryKey){
            $this->queryFactory->where($primaryKey, '=',$this->getValue($primaryKey));

        }

        $this->queryFactory->delete([$this->table]);
    }

    public static function instance(QueryFactory $queryFactory = null):self{
        if($queryFactory === null){
            $queryFactory = QueryFactory::instance();
        }
        $class = get_called_class();
        return new $class($queryFactory);
    }
}