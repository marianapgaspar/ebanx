<?php
namespace System\Models\Validations;

use System\Models\AModel;

class DontCaracter extends AValidation{

    private string $cat;


    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
        if (empty($data)){
            return true;
       }

    $this->terms = '\\'.$this->cat;
       if(preg_match("/{$this->terms}/i", $data)){
          $errors[$field]=$this->message;
          return false;
       }
        return true;
    }

    public function setCaracter(string $cat):self{
        $this->cat = $cat;
        return $this;
    }  
 
}