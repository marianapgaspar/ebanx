<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Gadgets\ASteps as GadgetsASteps;

class Step extends GadgetsASteps{
    
    public function html():string{
        $html = "       
                    <div class='container'>
                       
                            <ol class='progress'>";
                                $index = 0;                                
                                    foreach ($this->getSteps() as $key=>$value){
                                        $index++;
                                        $active=$value?"true":"false";
                                        if ($active == "true") {
                                            $active = "class = 'completed'";
                                        } elseif ($this->getStatus($key) !=false){
                                            $active = "class = 'is-active'";
                                        }
                                        $html.=
                                        "<li {$active}>
                                                {$this->getLayout()->getDictionary()->get($this->titles[$key])}
                                        </li>";
                                    }
                                $html .= "
                            </ol>
                        
                    </div> 
                        ";
        return  $html;
    }
    function prepare(){
        $this->layout->addCss(url()->toRoute('public/common/css/steps.css'));
        $this->layout->addJs(url()->toRoute('public/common/js/steps.js'));
    }
}