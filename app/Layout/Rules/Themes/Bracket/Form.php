<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Form\AForm;

class Form extends AForm {
    public function html():string{
      $attr = '';
        foreach($this->getAttr() as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }
        $html = "
        <div class='col-{$this->col}'>
        ";
       
          $html .="<div class='col-12 alert' display='none'></div>
        <form class=\"card card-default\" $attr enctype=\"multipart/form-data\">
       
        <div class=\"card-header\">
          <h3 class=\"card-title\">{$this->getLayout()->getDictionary()->get($this->getName())}</h3>
          <div class=\"nav nav-tabs card-header-tabs\">";
          foreach($this->links as $link){
            $html .= "
            <li class='nav-item'>
            <a class='nav-link {$this->setActive($link['url'])}' {$attr} style='font-weight:normal' href='{$link['url']}' target='{$link['target']}'>{$this->getLayout()->getDictionary()->get($link['name'])}</a>
            </li>";
            
          }
          $html .="</div>
        </div>
        <div class=\"card-body\"><div class=\"row\"> ";
        
        foreach($this->getComponents() as $name=>$input){
            $html .="<div class=\"col-md-{$this->getSizes()[$name]}\" id=\"componente_$name\">";
            $html .= $input->html();
            $html .="</div>";
        }
        $html .="</div></div>
        <div class=\"card-footer\">";
        $html .="<div class='row justify-content-center'>";
        foreach($this->getButtonsGroups() as $buttons){
          $html .= $buttons->html();
      }
      $html .="</div>";
      foreach($this->buttons as $button){
          $html .= $button->html();
      }
        $html .="</form>
      </div></div>";
      foreach($this->showIf as $input=>$rules){
        $script = "$('[name={$input}]').on('change',function(){";
        foreach($rules as $value=>$componentes){
          $ids = array_map(function ($data){
            return "#componente_".$data;
          },$componentes);
          $ids = implode(',',$ids);
          $script.=" if(\$(this).val()=='{$value}'){
              \$('$ids').show();
            }else{
              \$('$ids').hide();
            }";
        }
       $script .= "});";
       $script .= "$(function(){";
        foreach($rules as $value=>$componentes){
          $ids = array_map(function ($data){
            return "#componente_".$data;
          },$componentes);
          $ids = implode(',',$ids);
          $script.=" if(\$('[name={$input}]').val()=='{$value}'){
              \$('$ids').show();
            }else{
              \$('$ids').hide();
            }";
        }

        $script .="});";
        $this->getLayout()->addScript($script);
      }
      foreach($this->dontShowIf as $input=>$rules){
        $script = "$('[name={$input}]').on('change',function(){";
        foreach($rules as $value=>$componentes){
          $ids = array_map(function ($data){
            return "#componente_".$data;
          },$componentes);
          $ids = implode(',',$ids);
          $script.=" if(\$(this).val()=='{$value}'){
              \$('$ids').hide();
            }else{
              \$('$ids').show();
            }";
        }
       $script .= "});";
       $script .= "$(function(){";
        foreach($rules as $value=>$componentes){
          $ids = array_map(function ($data){
            return "#componente_".$data;
          },$componentes);
          $ids = implode(',',$ids);
          $script.=" if(\$('[name={$input}]').val()=='{$value}'){
              \$('$ids').hide();
            }else{
              \$('$ids').show();
            }";
        }

        $script .="});";
        $this->getLayout()->addScript($script);
      }
      
      if($this->ajax){
      $this->getLayout()->addScript(obfuscateJs("
            $(function(){
              $('#{$this->id}').submit(function(e){e.preventDefault();});
                $('#{$this->id}').find('button').on('click',function(){
                    var action = $(this).attr('formaction');
                    if(!action){
                      action =$('#{$this->id}').prop('action');
                    }
                    if($(this).attr('confirm-message')){
                      $('#modal-message').html($(this).attr('confirm-message'));
                      $('#accept-link').attr('href','javascript:formSubmit(\"'+action+'\",\'{$this->method}\',\'#{$this->id}\')');
                      $('.modal-form').modal('show');
                    }else{
                      formSubmit(action,'{$this->method}','#{$this->id}');
                    }
                });
                $('.alert').hide();
                $('input, select').on('change',function(){\$(this).removeClass('is-invalid');\$(this).parent().find('.error').remove()});
            });

            function formSubmit(action,method,idForm){
              $('#loading').show();
              $.ajax({
                url: action,
                type: method,
                data: $(idForm).serialize(),
                enctype: 'multipart/form-data',
                cache: false,
                success: function(data) {
                  $('#loading').hide();
                  console.log(data);
                  $('#modal-alert-message').html('Salvo com sucesso!');
                  if (data.message){
                    $('#modal-alert-message').html(data.message);
                  }
                  $('.modal-form').modal('hide');
                  if(data.redirect){
                    $('.redirect-button').attr('href',data.redirect);
                  }
                  $('.modal-alert').modal('show');

                },
                xhr: function() { // Custom XMLHttpRequest
                  var myXhr = $.ajaxSettings.xhr();
                  if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                      myXhr.upload.addEventListener('progress', function() {
                          /* faz alguma coisa durante o progresso do upload */
                      }, false);
                  }
                  return myXhr;
              },
                error: function (data) {
                  window.scrollTo(0, 0);
                  $('#loading').hide();
                    $('.modal-form').modal('hide');
                    data = data.responseJSON;
                    console.log(data);
                    if(data.errors){
                    $.each(data.errors, function(i, erro) {
                        $('[name='+i+']').addClass('is-invalid');
                        $('[name='+i+']').parent().append(\"<span id='exampleInputEmail1-error' class='error invalid-feedback'>\"+erro+\"</span>\");
                    });
                  }
                    if(data.message){
                      $('.alert').show();
                      $('.alert').html(
                        \"<div class='alert alert-danger alert-dismissible'> \"
                            + \"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> \"
                            + \"<h5><i class='icon fas fa-close'></i> Erro</h5> \"
                            + data.message
                        + \"</div> \"
                      );
                    } 
                }
            });
            } 

        "));
      }
      return $html.$this->modal().$this->modalAlert().'<div id="loading" style="display:none;"><h1>Loading...</h1></div>'.
      "<style>
        #loading{
          display: flex;
          align-items: center;
          justify-content: center;
          position:fixed;
          height:100%;
          width:100%;
          top:0;
          left:0;
          z-index:9999999;
          background-color: #a09d9d;
          color: black;
          opacity: 0.5;
        }
      </style>";
    }
    public function prepare(){
     
     
    }
    private function modal(){
      $html = '<div class="modal modal-form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alerta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p id="modal-message">Salvo com sucesso.</p>
                    </div>
                    <div class="modal-footer">
                      <a id="accept-link" class="btn btn-primary">Sim</a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>';
      return $html;
    }
    private function modalAlert(){
      $html = '<div class="modal modal-alert" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alerta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p id="modal-alert-message">Salvo com sucesso</p>
                    </div>
                    <div class="modal-footer">
                      <a href="javascript:location.reload();" class="btn btn-primary redirect-button">Entendi</a>
                    </div>
                  </div>
                </div>
              </div>';
      return $html;
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

          case AButton::BUTTON_WARNING;
              return "btn btn-warning";
      }
  }
}