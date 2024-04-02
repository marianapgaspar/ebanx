<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\AImage;
use App\Localisation\Rules\Localisation;


class Image extends AImage{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $image = $this->value?url()->toRoute($this->value):url()->toRoute('public/common/img/no-image.png');
        $attr .= "value=\"{$this->value}\" ";
        $_id = array_key_exists('id',$this->attrs)? $this->attrs['id']:'img_output';
        return "<div class=\"form-group\">
                    <label>{$this->layout->getDictionary()->get($this->name)}<br>
                    <img id=\"output\" style='width:100%' class=\"img-fluid img-thumbnail img-{$_id}\" src='".$image."'>
                    <input style='display:none' onchange=\"loadFile(event,'{$_id}')\" type=\"file\" class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                    </label>
                </div>";
    }

    public function prepare(){
                /**
         * @author Felipe Corassari de Lima
         * @since 02/09/2021
         * adaptado para capturar o ID do campo informado
         * utilizando a mesma funcao com o evento em questao
         */
  
        $this->layout->addScript("
            var loadFile = function(event,id) {
                var idField = id;
                var reader = new FileReader();
                reader.onload = function(){
                   // var output = document.getElementById('output');
                    var output = $('.img-'+idField).attr('src',reader.result);
                    //output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
        
        ");
        $this->layout->addCss(url()->toRoute('public/common/css/danica.css'));
    }
}