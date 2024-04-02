<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ADate;

class Date extends ADate{
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
                    <input  class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                </div>";
    }
    public function prepare(){
        $this->layout->addCss(url()->toRoute('public/common/css/jquery-ui.min.css'));
        $this->layout->addJs(url()->toRoute('public/common/js/jquery-ui.min.js'));
        $this->layout->addScript("$('[name={$this->name}]').datepicker({dateFormat:'{$this->format}'});");
    }
}