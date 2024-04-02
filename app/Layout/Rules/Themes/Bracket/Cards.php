<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Cards\ACards;

class Cards extends ACards {
    public function html():string{
        $html = "
            <div class='row row-sm mg-t-20'>";
        
            foreach($this->getComponents() as $name=>$card){
                $html .="<div class=\"col-md-{$this->getSizes()[$name]}\" id=\"componente_$name\">";
                $html .= $card->html();
                $html .="</div>";
            }
            $html .= "
            </div>
        ";
        
        return $html;
    }
    public function prepare(){
        
    }
}