<?php
namespace System\Models\Validations;

use System\Models\AModel;

class Required extends AValidation{

    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
        if (empty($data)){
        $errors[$field]=$this->message;
        return false; 
       }
       
        return true;
    }
    
}