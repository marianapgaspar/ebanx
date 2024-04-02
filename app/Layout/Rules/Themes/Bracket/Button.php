<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Buttons\AButton;

class Button extends AButton {
    public function html():string{
        $attr = '';
        foreach($this->getAttr() as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        return "<button style='margin:5px;' class=\"{$this->getClass($this->getType())}\" $attr>{$this->getLayout()->getDictionary()->get($this->getName())}</button>";
    }

    private function getClass(string $type){
        switch($type){
            case AButton::BUTTON_DEFAULT: 
                return "btn btn-default";
            case AButton::BUTTON_SUCCESS:
                return "btn btn-success";
            case AButton::BUTTON_DANGER:
                return "btn btn-danger";
            case AButton::BUTTON_DARK;
                return "btn btn-dark";
            case AButton::BUTTON_INFO;
                return "btn btn-info";
            case AButton::BUTTON_LIGHT;
                return "btn btn-light";
            case AButton::BUTTON_PRIMARY;
                return "btn btn-primary";
            case AButton::BUTTON_SECONDARY;
                return "btn btn-secondary";

            case AButton::BUTTON_OUTLINE_PRIMARY;
                return "btn btn-outline-primary";
            case AButton::BUTTON_OUTLINE_SECONDARY;
                return "btn btn-outline-secondary";
            case AButton::BUTTON_OUTLINE_SUCCESS;
                return "btn btn-outline-success";
            case AButton::BUTTON_OUTLINE_WARNING;
                return "btn btn-outline-warning";
            case AButton::BUTTON_OUTLINE_DANGER:
                return "btn btn-outline-danger";
            case AButton::BUTTON_OUTLINE_DARK;
                return "btn btn-outline-dark";
            case AButton::BUTTON_OUTLINE_INFO;
                return "btn btn-outline-info";
            case AButton::BUTTON_OUTLINE_LIGHT;
                return "btn btn-outline-light";
  
            case AButton::BUTTON_WARNING;
                return "btn btn-warning";
        }
    }
}