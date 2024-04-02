<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ARadio;

class Radio extends ARadio{ 
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $html = "<div class=\"form-group\">
                    <label>{$this->getLayout()->getDictionary()->get($this->name)}</label>";
        foreach($this->fields as $field){
            $checked = $this->values==$field? 'checked':'';
            $html .= "<div class=\"form-check mg-l-20\">
                <input name='{$this->name}' class=\"form-check-input\" type=\"radio\" value='{$field}' {$checked}>
                <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
            </div>";
        }
        
        $html .="</div>";
        return $html;
    }
}