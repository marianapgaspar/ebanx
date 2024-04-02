<?php
namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ADatetime;
use App\Localisation\Rules\Localisation;

class Datetime extends ADatetime{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        // $attr .= "value=\"{$this->value}\" ";
        return "<div class=\"form-group\">
                    <label>{$this->layout->getDictionary()->get($this->name)}</label>
                    <input  class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\" type='{$this->type}'>
                </div>";
    }
    public function prepare(){
        $this->layout->addJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js');
        $this->layout->addJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js');

        $this->layout->addCss("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css");
        // $this->layout->addScript("$('[name={$this->name}]').datetimepicker({format:'dd/mm/YY'});");
    }
}