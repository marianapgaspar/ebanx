<?php
namespace System\Models\Validations;

use System\Models\AModel;
class Date extends AValidation{
    function validate(string|int|float|AModel|null $data,AModel $model,string $field, array &$errors):bool{
       
        if(!$data){
            return true;
        }
        $datetime = \DateTime::createFromFormat('Y-m-d',$data);
        if (!is_null($datetime)){
            return true;
        } else {
            $errors[$field]=$this->message;
            return false;
        }       
    }
}