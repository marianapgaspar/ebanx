<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\ACard;

class Card extends ACard {
    public function html():string{
        $html = '';
           
            if ($this->backgroundColor){
                $html .= "<div class='card card-body bd-0  tx-{$this->txtColor}-8 bg-{$this->backgroundColor} rounded-bottom'>";
            } else {
                $html .= "<div class='card'>";
            }
            
            if ($this->title){
                $html.="<div class='card-header d-flex align-items-center justify-content-between pd-y-10'><h6 class='mg-b-0 tx-14 tx-inverse'>{$this->title}</h6>";
                    $html .='<div class="card-option tx-24">';
                    if ($this->links){
                        foreach ($this->links as $link){
                            $html.= "<a href='{$link['url']}' class='tx-gray-600 mg-l-10'> <i class='{$link['icon']}'></i></a>";
                        }
                    }
                    $html.=' </div>';
                $html.=' </div>';
            }
            if ($this->body){
                $html .= "<div class='card-body bd-0 rounded-bottom'>{$this->body}</div>";
            } 
            if ($this->texto){
                $html .= "<p class='card-text'>{$this->texto}</p>";
            }  
                 
        $html .= "
        </div>";
        if ($this->imagem){
            $html .= "<img class='card-img-top img' src='{$this->imagem}' alt='{$this->imagem}' height='{$this->imageHeight}'>";
        } 
        return $html;
    }
    public function prepare(){

    }
}