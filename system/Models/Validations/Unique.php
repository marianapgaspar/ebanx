<?php
namespace System\Models\Validations;

use System\Models\AModel;
use System\Models\TableModel;

class Unique extends AValidation{

    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
        if(!($model instanceof TableModel)){           
            return true;
        } 
        if (strpos($field,',')!== false){
            $fields = (array)explode(",", $field);
        } else{
            $fields = [$field];
        }
        $model = clone $model;
        foreach ($fields as $field){
            if (!($model->{$field})){
                $model->query()->where($field,'IS','NULL', false);
                continue;
            }
            $model->query()->where($field,'=',$model->{$field});
        }
        $count = $model->query()->get()->getNumRows();
        if ($count){
            $errors[reset($fields)]= $this->getMessage();
            return false;
        }
        return true;
    }
}