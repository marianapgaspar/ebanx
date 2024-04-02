<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Rules\Form\AForm;

class Form extends AForm {
    public function html():string{
      $attr = '';
        foreach($this->getAttr() as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $html = "
        <div class='col-12 alert'></div>
        <form class=\"card card-default\" $attr>
       
        <div class=\"card-header\">
          <h3 class=\"card-title\">{$this->getLayout()->getDictionary()->get($this->getName())}</h3>
          <div class=\"card-tools\">
          </div>
        </div>
        <div class=\"card-body\"><div class=\"row\"> ";
        
        foreach($this->getComponents() as $name=>$input){
            $html .="<div class=\"col-md-{$this->getSizes()[$name]}\">";
            $html .= $input->html();
            $html .="</div>";
        }
        $html .="</div></div>
        <div class=\"card-footer\">";
        foreach($this->getButtonsGroups() as $name=>$buttons){
            $html .= '<div class="col-xs-12 col-md-4">
            <div class="card">
            <div class="card-header">Representante</div>
            <div class="card-body">';
                    foreach($buttons as $button){
                        $html .= $button->html();
                    }
                    

            $html .="</div></div></div>";
        }
        foreach($this->buttons as $button){
            $html .= $button->html();
        }
        $html .="</form>
      </div>";
      return $html;
    }
    public function prepare(){
        
      if(!$this->ajax){
        return;
      }
      $this->getLayout()->addScript(obfuscateJs("
            $(function(){
                $('#{$this->id}').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '{$this->action}',
                        type: '{$this->method}',
                        data: $('#{$this->id}').serialize(),
                        cache: false,
                        success: function(data) {
                            $('.alert').html(
                                \"<div class='alert alert-success alert-dismissible'> \"
                                    + \"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> \"
                                    + \"<h5><i class='icon fas fa-check'></i> Sucesso!</h5> \"
                                    + \"Salvo com sucesso. \"
                                + \"</div> \"
                            );
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            console.log(data);
                            $.each(data.errors, function(i, erro) {
                                $('[name='+i+']').addClass('is-invalid');
                                $('[name='+i+']').parent().append(\"<span id='exampleInputEmail1-error' class='error invalid-feedback'>teste</span>\");
                            });
                        }
                    });
                });
                $('input, select').on('change',function(){\$(this).removeClass('is-invalid');\$(this).parent().find('.error').remove()});
            });
        "));
    }
}