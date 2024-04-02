<?php
namespace System\Models\Validations;

use System\Models\AModel;

class Min extends AValidation{

    private int|float $min = 0;


    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
        if (empty($data)){
            return true;
       }
       //if ($this->min !=0){
            if ($data < $this->min){
                $errors[$field]=$this->message;
                return false;
            }
       //} 
       return true;
    }
    public function setMin(int|float $min):self{
        $this->min = $min;
        return $this;
    }    
}