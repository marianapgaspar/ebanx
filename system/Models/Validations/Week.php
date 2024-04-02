<?php
namespace System\Models\Validations;

use System\Models\AModel;
class Week extends AValidation{
    function validate(string|int|float|AModel|null $data,AModel $model,string $field, array &$errors):bool{
       
        if(!$data){
            return true;
        }
        if (preg_match("/^([0-9]{2}\/[0-9]{2})$/", $data) && $data != ""){
            return true;
        } else {
            $errors[$field]=$this->message;
            return false;
        }       
    }
}