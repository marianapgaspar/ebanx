<?php

namespace App\Export\Rules\Table;

class Csv extends AExport{
    function export(string $file){
        $string = '';
        $path = explode('/',$file);
        $pathString = '';
        foreach($path as $segment){
            $pathString .= $segment.'/';
            if(!is_dir($pathString) && strpos($segment,'.')===false){
                mkdir($pathString);
            }
        }
        $string .= implode(';',array_map(function($data){return addslashes($data);},$this->columns)).PHP_EOL;

        foreach($this->data as $data){
            $string .= implode(';',array_map(function($data){return addslashes($data);},$data->toArray())).PHP_EOL;
        }
        file_put_contents($file,$string);
    }
}