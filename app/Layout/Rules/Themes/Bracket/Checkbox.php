<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ACheckbox;

class Checkbox extends ACheckbox{ 
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $html = "<div class=\"form-group\">
                    <label>{$this->getLayout()->getDictionary()->get($this->name)}</label>";
        foreach($this->fields as $value=>$field){
            if(in_array($value,(array)$this->value)){
                $html .= "<div class=\"form-check mg-l-20\">
                    <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$value}' checked>
                    <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
                </div>";
                continue;
            }
            $html .= "<div class=\"form-check  mg-l-20\">
                <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$value}'>
                <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
            </div>";
        }
        if($this->groupFields){
            $html .= '<div class="row" style="padding:0px 15px">';
        }
        foreach($this->groupFields as $group=>$fields){
            $html .="<div class='col-3'>";
            $html .= "<label>{$this->getLayout()->getDictionary()->get($group)}</label>";
            foreach($fields as $value=>$field){
                if(in_array($value,(array)$this->value)){
                    $html .= "<div class=\"form-check mg-l-20\">
                        <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$value}' checked>
                        <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
                    </div>";
                    continue;
                }
                $html .= "<div class=\"form-check  mg-l-20\">
                    <input name='{$this->name}[]' class=\"form-check-input\" type=\"checkbox\" value='{$value}'>
                    <label class=\"form-check-label\">{$this->getLayout()->getDictionary()->get($field)}</label>
                </div>";
            }
            $html .="</div>";
        }
        if($this->groupFields){
            $html .= '</div>';
        }
        $html .="</div>";
        return $html;
    }
}