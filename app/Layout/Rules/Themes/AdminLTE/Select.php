<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\ASelect;

class Select extends ASelect{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }

        $options = "";

        foreach($this->options as $value=>$name){
            if($value==$this->value){
                $options .= "<option selected value=\"$value\">$name</option>";
                continue;
            }
            $options .= "<option value=\"$value\">$name</option>";
        }
        return "<div class=\"form-group\">
                    <label>{$this->layout->getDictionary()->get($this->name)}</label>
                    <select type=\"text\" class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                    $options
                    </select>
                </div>";
    }
}