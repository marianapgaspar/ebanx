<?php
namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\ASelect2;

class Select2 extends ASelect2{
    public function html():string{
        if($this->multiple){
            $this->addAttr('name',$this->name.'[]');
        }
        $attr = '';

        foreach($this->attrs as $name=>$value){
            $attr .= "$name=\"$value\" ";
        }

        $options = "";
       
        foreach($this->options as $value=>$name){
          
            if(is_array($this->value)){
                if(in_array($value,$this->value)){
                    $options .= "<option selected value=\"$value\">$name</option>";
                    continue;
                }
            }
            if($value==$this->value){
                $options .= "<option selected value=\"$value\">$name</option>";
                continue;
            }
            $options .= "<option value=\"$value\">$name</option>";
        }
        foreach($this->selectedOptions as $value=>$label){
            $options .= "<option selected value=\"{$value}\">$label</option>";
        }

        if($this->ajax){
            $this->ajaxScript();
        }else{
            $this->getLayout()->addScript("\$(function(){\$('#{$this->idSelect2}').select2({width:'100%'});});");
        }
        $label = '<label>'.$this->layout->getDictionary()->get($this->name).'</label>';
        if(!$this->showLabel){
            $label = '';
        }
        $html = 
        "<div class=\"form-group form-group-select2 \">
            {$label}
            <div class='input-group'>
                <select id=\"{$this->idSelect2}\" type=\"text\" class=\"form-control\" {$attr}placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                $options
                </select>";
        if ($this->removable){
            $html .= "
            <div class='input-group-append'>
                <a type='a' onclick='$(\"#{$this->idSelect2} option:selected\").remove();' class='btn btn-outline-secondary'><i class='fa fa-times'></i></a> 
            </div>";
        }
        $html .= "     
            </div>
        </div>";
        return $html;
    }
    private function ajaxScript(){
        $this->getLayout()->addScript("
        \$(function(){
            $('#{$this->idSelect2}').select2({
                placeholder: '".$this->layout->getDictionary()->get($this->name)."',
                width:'100%',
                ajax: {
                    delay: 200,
                    url: '{$this->url}',
                    data:function (params) {
                        return {{$this->searchKey}:params.term};
                    },
                    dataType: 'json',
                    processResults: function (data) {                        
                        console.log(data);
                        return {
                            results: $.map(data, function (item) {
                                if(item.{$this->valueKey} != ''){                               
                                    item.text = item.{$this->valueKey};
                                    item.id =  item.{$this->key}
                                    return item;
                                }
                            })
                        };
                    }
                  },
                  width: '100%',
            });});
        ");
    }
    public function prepare()
    {
        $this->idSelect2 = uniqid('select2');
        
    }
}