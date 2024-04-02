<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\AHidden;

class Hidden extends AHidden{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $attr .= "value=\"{$this->value}\" ";
        return "
                    <input type=\"hidden\" class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                ";
    }
}