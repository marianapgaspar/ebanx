<?php
namespace System\Models;

use System\Exceptions\ValidationException;
use System\Models\Validations\AValidation;

class Validation{


    private array $validations = [];
    private array $fields=[];

    public function addValidation(string $name, AValidation $validation){
        $this->validations[$name][] = $validation;
        $this->fields[] = $name;
    }

    public function validate(AModel $model){
        $errors = [];
        foreach($this->fields as $field){
            
            $validations = $this->validations[$field];
            foreach($validations as $validation){
                $validation->validate($model->{$field},$model,$field,$errors);
                
            }
            
        }
        if($errors){
            throw new ValidationException('Validation error',$errors);
        }
    }
    
}