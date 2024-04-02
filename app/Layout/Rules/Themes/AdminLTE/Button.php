<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Buttons\AButton;

class Button extends AButton {
    public function html():string{
        $attr = '';
        foreach($this->getAttr() as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        return "<button class=\"{$this->getClass($this->getType())} pull-right\" $attr>{$this->getLayout()->getDictionary()->get($this->getName())}</button>";
    }

    private function getClass(string $type){
        switch($type){
            case AButton::BUTTON_DEFAULT: 
                return "btn btn-default";
            case AButton::BUTTON_SUCCESS:
                return "btn btn-success";
            case AButton::BUTTON_DANGER:
                return "btn btn-danger";
        }
    }
}