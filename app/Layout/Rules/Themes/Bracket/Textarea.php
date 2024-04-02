<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ATextarea;

class Textarea extends ATextarea
{
    public function html(): string
    {
        $attr = '';

        foreach ($this->attrs as $name => $value) {
            $attr .= "$name=\"$value\" ";
        }

        $classEditor = $this->getEditor()? 'editor':'';
        return "<div class=\"form-group\">
                    <label>{$this->layout->getDictionary()->get($this->name)}</label>
                    <textarea class=\"form-control $classEditor\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">{$this->value}</textarea>
                </div>";
    }

    public function prepare()
    {
        
        $this->layout->addJs(url()->toRoute('public/common/bracket/js/ckeditor.js'));
        $this->layout->addScript("
        
            ClassicEditor
                .create( document.querySelector( '.editor' ) )
                .then( editor => {
                    console.log( editor );
                })
                .catch( error => {
                    console.error( error );
                 });
            
            ");

    }
}
