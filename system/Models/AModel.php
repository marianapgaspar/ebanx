<?php
namespace System\Models;

abstract class AModel{
    protected array $fields = [];
    protected array $values = [];
    protected array $protectedFields = [];

    public function setValue(string $field, string|int|array|float|AModel|null $value = null):self{
        if(!in_array($field,$this->fields)){

        }
        $this->values[$field] = $value;
        return $this;
    }

    public function getValue(string $field):string|int|array|float|AModel|null{
        if(!in_array($field,$this->fields)){

        }
        if(!isset($this->values[$field])){
            return null;
        } 
        if(in_array($field,$this->protectedFields)){
            //return null;
        }
        return $this->values[$field];
    }

    protected function getProtectedValue(string $field):string|int|float|AModel|null{
        if(!in_array($field,$this->fields)){

        }
        if(!isset($this->values[$field])){
            return null;
        } 
        return $this->values[$field];
    }
    public function __get($field):string|int|float|array|AModel|null
    {
        return $this->getValue($field);
    }
    public function __set(string $field,string|array|int|float|AModel|null $value = null){
        $this->setValue($field,$value);
    }

    public function setValues(array $values){
        foreach($values as $field=>$value){
            $this->setValue($field,$value);
        }
    }

    public function getFields():array{
        return $this->fields;
    }

    public function toArray():array{
        return $this->values;
    }
}