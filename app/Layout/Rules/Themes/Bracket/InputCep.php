<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\AInputCep;


class InputCep extends AInputCep{
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
                    <input id='inputCep_cep' onchange='getCep()'  class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                </div>";
    }

    public function prepare()
    {
        $this->getLayout()->addJs(\url()->toRoute('public/common/js/inputCep.js'));

    }
}