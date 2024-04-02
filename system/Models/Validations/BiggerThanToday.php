<?php
namespace System\Models\Validations;

use System\Models\AModel;
use System\Tools\Time;

class BiggerThanToday extends AValidation{
    function validate(string|int|float|AModel|null $data,AModel $model,string $field, array &$errors):bool{
        if(!$data){
            return true;
        }
        if (strtotime($data)>=strtotime(date('Y-m-d'))){
            return true;
        } else {
            $errors[$field]=$this->message;
           return false;
        }
    }
}