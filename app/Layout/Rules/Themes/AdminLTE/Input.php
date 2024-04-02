<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\AInput;

class Input extends AInput{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $attr .= "value=\"{$this->value}\" ";
        return "<div class=\"form-group\">
                    <label>{$this->layout->getDictionary()->get($this->name)}</label>
                    <input  class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                </div>";
    }
}