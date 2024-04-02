<?php
namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Buttons\AButtonGroup;

class ButtonGroup extends AButtonGroup{
    public function html():string{
        $html = '';
            $html .= '<div class="col-xs-12 col-md-3">
            <div class="card">
            <div class="card-header">'.$this->getLayout()->getDictionary()->get($this->title).'</div>
            <div class="card-body" style="text-align:center">';
                    foreach($this->buttons as $button){
                        $html .= $button->html();
                    }
                    
  
            $html .="</div></div></div>";
            return $html;
    }
}