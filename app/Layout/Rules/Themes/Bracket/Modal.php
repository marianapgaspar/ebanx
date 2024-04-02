<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\AModal;
use App\Localisation\Rules\Localisation;

class Modal extends AModal
{
  public function html(): string
  {
    $buttons = '';
    if ($this->buttons) {
      foreach ($this->buttons as $key => $value) {
        $buttons .= $value; //'<button type="button" id="' . $value . '" class="btn btn-primary tx-size-xs">' . $value . '</button>';
      }
    }


    
    return '
    <div id="'.$this->id.'" class="modal fade" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog modal-'.$this->size.'" role="document" >
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">'.$this->title.'</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pd-20">
        '.$this->body.'
        </div><!-- modal-body -->
        <div class="modal-footer">
          '.$buttons.'
          <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Sair</button>
        </div>
      </div>
    </div><!-- modal-dialog -->
  </div>    
    ';
  }

  public function prepare()
  {
    
    //$this->layout->addJs(url()->toRoute('public/common/js/jquery.mask.min.js'));

  }
}