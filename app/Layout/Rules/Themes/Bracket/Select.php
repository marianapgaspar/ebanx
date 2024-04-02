<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Components\ASelect;

class Select extends ASelect
{
    public function html(): string
    {
        
        $buttonsMultiSelect = '';
        if ($this->multiSelect) {
            $buttonsMultiSelect= '<div class="row">';
            $buttonsMultiSelect.= '<div class="col-md-6"> <a href="#" class="btn btn-primary btn-sm" id="select-all">Adicionar Todos</a></div>'; 
            $buttonsMultiSelect.= '<div class="col-md-6"><a href="#" class="btn btn-primary btn-sm" id="deselect-all">Remover Todos</a></div>'; 
            $buttonsMultiSelect.= '</div>';
            $this->setMultiple(true);
            $this->addAttr('id','multiselect');
        }  

        if ($this->multiple) {
            $this->addAttr('name', $this->name . '[]');
        }
        $attr = '';

        foreach ($this->attrs as $name => $value) {
            $attr .= "$name=\"$value\" ";
        }

        $options = "";

        foreach($this->options as $value=>$name){
          
            if(is_array($this->value)){
                if(in_array($value,$this->value)){
                    $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                    continue;
                }
            }
            if($value==$this->value){
                $options .= "<option selected value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
                continue;
            }
            if (in_array($value,array_keys($this->selectedOptions))){
                foreach($this->selectedOptions as $value=>$label){
                    $options .= "<option selected value=\"{$value}\">$label</option>";
                }
                continue;
            }
            // $options .= "<option value=\"$value\">$name</option>";
            $options .= "<option value=\"$value\">{$this->getLayout()->getDictionary()->get($name)}</option>";
        }
        // foreach($this->selectedOptions as $value=>$label){
        //     $options .= "<option selected value=\"{$value}\">$label</option>";
        // }        
      
        $label = '<label>' . $this->layout->getDictionary()->get($this->name) . '</label>';
        if (!$this->showLabel) {
            $label = '';
        }

        return "
            {$buttonsMultiSelect}
            <div class=\"form-group\" style='width:100%'>
                {$label}
                <select type=\"text\" class=\"form-control\" {$attr} placeholder=\"{$this->layout->getDictionary()->get($this->name)}\">
                $options
                </select>
            </div>";
    }


    public function prepare()
    {
        
        $this->layout->addJs(url()->toRoute('public/common/js/jquery.multi-select.js'));
        $this->layout->addCss(url()->toRoute('public/common/css/multi-select.css'));
        $this->layout->addScript("
                $('#multiselect').multiSelect({
                    
                });
                $('#select-all').click(function(){
                $('#multiselect').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all').click(function(){
                $('#multiselect').multiSelect('deselect_all');
                    return false;
                });            
            ");

    }    
}
