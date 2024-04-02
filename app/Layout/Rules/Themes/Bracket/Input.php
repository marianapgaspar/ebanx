<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\AInput;
use App\Localisation\Rules\Localisation;

class Input extends AInput{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $attr .= "value=\"{$this->value}\" ";

        $label = '<label>'.$this->layout->getDictionary()->get($this->name).'</label>';
        if(!$this->showLabel){
            $label = '';
        }               
        return "<div class=\"form-group\">
                    {$label}
                    <input  class=\"{$this->class}\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                </div>";
    }

    public function prepare()
    {
        $this->layout->addJs(url()->toRoute('public/common/js/jquery.mask.min.js'));

    }
}