<?php 
namespace System\Models\Validations;

use System\Models\Validations\AValidation;
use System\Models\AModel;

class Multiplo extends AValidation {
    private int|float $number = 1;

    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
    
        if (empty($data)){
            return true;
        }
       $result = $data/$this->number;
        if (!is_int($result)){
            if (!strripos((string)$result,'.')){
                return true;
            }
            $errors[$field]=$this->message;
            return false; 
        }
        return true;
    }

    public function setMultiplo(int|float $number):self{
        $this->number = $number;
        return $this;
    } 
}