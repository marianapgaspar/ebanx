<?php
namespace System\Models\Validations;

use System\Models\AModel;

class Max extends AValidation{

    private int|float $max = 0;


    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
        if (empty($data)){
            return true;
       }
       if ($this->max !=0){
            if ($data >  $this->max){
                $errors[$field]=$this->message;
                return false;
            }
       } return true;
    }
    public function setMax(int|float $max):self{
        $this->max = $max;
        return $this;
    }    
}