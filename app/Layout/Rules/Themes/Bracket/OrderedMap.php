<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\AOrderedMap;

class OrderedMap extends AOrderedMap{
    public function html():string{
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }

        
        $html = "<div class=\"form-group\">
        <label>{$this->layout->getDictionary()->get($this->name)}";
        $html .= "<a class=\"btn btn-outline-secondary\" onclick=\"{$this->functionName}Add($(this))\"><i class=\"fa fa-plus\"></i></a></label>";
        
        if($this->value && is_array($this->value)){
            for($i=0;$i<count($this->value[0]);$i++){
                $html .="<div class=\"input-group\">";
                $index = 0;
                foreach($this->map as $element){
                    if($element == self::INPUT_COMPONENT){
                        $html .="<input type=\"text\" value=\"{$this->value[$index][$i]}\" name=\"{$this->name}[{$index}][]\" class=\"form-control\"/>";
                        $index++;
                        continue;
                    }
                    if($element == self::SELECT_COMPONENT){
                        $options = "";
                        foreach($this->options as $value=>$name){
                            if($value==$this->value[$index][$i]){
                                $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                                continue;
                            }
                            $options .= "<option value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                        }
                        $html .="<select name=\"{$this->name}[{$index}][]\" class=\"form-control\">";
                        $html .= $options;
                        $html .="</select>";
                    }
                    $index++;
                }
                $html .= "<div class=\"input-group-append\"><a class=\"btn btn-outline-secondary\" type=\"a\" onclick=\"{$this->functionName}After($(this))\"><i class=\"fa fa-plus\"></i></a>
                <a type=\"a\" onclick=\"{$this->functionName}Delete($(this))\" class=\"btn btn-outline-secondary\"><i class=\"fa fa-times\"></i></a> </div> </div>";
            }
        }else{
        $html .="<div class=\"input-group\">";
        $index = 0;
        foreach($this->map as $element){
            if($element == self::INPUT_COMPONENT){
                $html .="<input type=\"text\" name=\"{$this->name}[{$index}][]\" class=\"form-control\"/>";
                $index++;
                continue;
            }
            if($element == self::SELECT_COMPONENT){
                $options = "";
                foreach($this->options as $value=>$name){
                    if($value==$this->value){
                        $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                        continue;
                    }
                    $options .= "<option value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                }
                $html .="<select name=\"{$this->name}[{$index}][]\" class=\"form-control\">";
                $html .= $options;
                $html .="</select>";
            }
            $index++;
        }
        $html .= "<div class=\"input-group-append\"><a class=\"btn btn-outline-secondary\" type=\"a\" onclick=\"{$this->functionName}After($(this))\"><i class=\"fa fa-plus\"></i></a>
        <a type=\"a\" onclick=\"{$this->functionName}Delete($(this))\" class=\"btn btn-outline-secondary\"><i class=\"fa fa-times\"></i></a> </div> </div>";
    }
        return $html."</div>";

        
    }
    public function prepareMap(){
        $this->functionName = uniqid('func');
        $script = "function {$this->functionName}After(element){
            element.parent().parent().after('<div class=\"input-group\">";
            $index = 0;
            foreach($this->map as $element){
                if($element == self::INPUT_COMPONENT){
                    $script .="<input type=\"text\" name=\"{$this->name}[{$index}][]\" class=\"form-control\"/>";
                    $index++;
                    continue;
                }
                if($element == self::SELECT_COMPONENT){
                    $options = "";
                    foreach($this->options as $value=>$name){
                        if($value==$this->value){
                            $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                            continue;
                        }
                        $options .= "<option value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                    }
                    $script .="<select name=\"{$this->name}[{$index}][]\" class=\"form-control\">";
                    $script .= $options;
                    $script .="</select>";
                }
                $index++;
                
            }
            $script .= "<div class=\"input-group-append\"><a type=\"a\" class=\"btn btn-outline-secondary\" onclick=\"{$this->functionName}After($(this))\"><i class=\"fa fa-plus\"></i></a>".
            "<a type=\"a\" onclick=\"{$this->functionName}Delete($(this))\" class=\"btn btn-outline-secondary\"><i class=\"fa fa-times\"></i></a> </div> </div>');";
            
        $script .="}";

        $script .= "function {$this->functionName}Add(element){
            element.parent().after('<div class=\"input-group\">";
            $index = 0;
            foreach($this->map as $element){
                if($element == self::INPUT_COMPONENT){
                    $script .="<input type=\"text\" name=\"{$this->name}[{$index}][]\" class=\"form-control\"/>";
                    $index++;
                    continue;
                }
                if($element == self::SELECT_COMPONENT){
                    $options = "";
                    foreach($this->options as $value=>$name){
                        if($value==$this->value){
                            $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                            continue;
                        }
                        $options .= "<option value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                    }
                    $script .="<select name=\"{$this->name}[{$index}][]\" class=\"form-control\">";
                    $script .= $options;
                    $script .="</select>";
                }
                $index++;
                
            }
            $script .= "<div class=\"input-group-append\"><a type=\"a\" class=\"btn btn-outline-secondary\" onclick=\"{$this->functionName}After($(this))\"><i class=\"fa fa-plus\"></i></a>".
            "<a type=\"a\" onclick=\"{$this->functionName}Delete($(this))\" class=\"btn btn-outline-secondary\"><i class=\"fa fa-times\"></i></a> </div> </div>');";
            
        $script .="}";
        $script .= "function {$this->functionName}Delete(element){
            element.parent().parent().remove();
        }";
        $this->getLayout()->addScript($script);
    }
}