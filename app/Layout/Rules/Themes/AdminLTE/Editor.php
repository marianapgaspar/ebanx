<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\AEditor;
use App\Layout\Rules\Components\Inputs\AInput;

class Editor extends AEditor{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
                return "<label>{$this->getLayout()->getDictionary()->get($this->getName())}</label><textarea $attr>
              </textarea>";
    }
    public function prepare(){
        $this->getLayout()->addJs(\url()->toRoute('public/common/plugins/summernote/summernote-bs4.min.js'));
        $this->getLayout()->addCss(\url()->toRoute('public/common/plugins/summernote/summernote-bs4.min.css'));
        $this->getLayout()->addScript(obfuscateJs("$(function () {\$('[name={$this->getName()}]').summernote()});"));
        $this->getLayout()->addCss("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback");
    }
}