<?php

namespace App\Localisation\Rules;

use App\Localisation\Models\Localisation as ModelsLocalisation;
class Dictionary{
    private array $map;
    private ModelsLocalisation $model;
    public function __construct(ModelsLocalisation $model)
    {
        $this->model = $model;
    }

    public function loadFile(string $fileName){
        $contents = file_get_contents(url()->toPath("public/localisation/{$this->model->code}/{$fileName}.json"));
        $map = json_decode($contents,true);
        if(!$map){
            return;
        }
        foreach($map as $key=>$value){
            $this->map[$key] = $value;
        }
    }

    public function set(string $key,string $value){
        $this->map[$key] = $value;
    }

    public function get($key){
        if(!isset($this->map[$key])){
            return $key;
        }
        return $this->map[$key];
    }
}