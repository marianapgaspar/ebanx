<?php

namespace App\Trigger\Rules;

use App\Layout\Rules\Form\AForm;
use App\Trigger\Models\Triggers;
use System\Models\AModel;

class File extends ATrigger{
    public function createForm(AForm $form)
    {
        $form->textarea('file_config');
        $form->input('file_path');
        $form->showIf('class',Triggers::TRIGGER_CLASS_FILE,['file_config','file_path']);
    }
    public function dispach(AModel $model,Triggers $trigger)
    {
        $object = json_decode($trigger->config);
        $fileConfig = $object->file_config;
        $fileInstance =$this;
        $fileContents =  preg_replace_callback('/{[0-9a-zA-Z_]*}/',function($match) use ($model){
            $match = str_replace(['{','}'],'',$match[0]);
            return $model->{$match};
        },$fileConfig);
        $fileContents =  preg_replace_callback('/{[0-9]*,[0-9a-zA-Z_]*}/',function($match) use ($fileInstance,$model){
            $match = str_replace(['{','}'],'',$match[0]);
            $match = explode(',',$match);
            $match[1] = $model->{$match[1]};
            return $fileInstance->str_fixa_tamanho($match[1],$match[0]);
        },$fileContents);
        
        $fileContents = str_replace('BREAK',PHP_EOL,$fileContents);
        file_put_contents(url()->toPath($object->file_path),$fileContents);
        
    }

    function populateModel(Triggers $model,array $post){
        $object = new \stdClass;
        $object->file_config = str_replace("\r\n",'BREAK',$post['file_config']);
        $object->file_path = $post['file_path'];

        $model->config = json_encode($object);
    }

    function populateForm(AForm $form,Triggers $model){
        
        $object = json_decode($model->config);
        $form->getInput('file_config')->setValue(str_replace('BREAK',"\r\n",$object->file_config));
        $form->getInput('file_path')->setValue($object->file_path);
    }
    public function str_fixa_tamanho($string, $comprimento, $preencimento = " ", $esquerda = false){
        $espacos = "";
        $string_ansi = iconv("UTF-8", "Windows-1252", $string);
        
        for ($x = 0; $x < $comprimento - strlen($string_ansi); $x++) {
            $espacos .= $preencimento;
        }
    
        if ($esquerda)
            return $espacos.$string_ansi;
        else
            return $string_ansi.$espacos;
    }
}