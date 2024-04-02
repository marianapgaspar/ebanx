<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Rules\Components\ACheckbox;

class Checkbox extends ACheckbox{ 
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $html = "<div class=\"form-group\">
                    <label>{$this->getLayout()->getDictionary()->get($this->name)}</label>";
        foreach($this->fields as $field){
            if(in_array($field,$this->values)){
                $html .= "<div class=\"form-check\">
                    <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$field}' checked>
                    <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
                </div>";
                continue;
            }
            $html .= "<div class=\"form-check\">
                <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$field}'>
                <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
            </div>";
        }
        
        $html .="</div>";
        return $html;
    }
}