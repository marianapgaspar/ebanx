<?php
namespace App\Layout\Rules\Components;

abstract class ASelect extends AInput{


    protected array $options = [];
    protected bool $multiple = false;
    protected bool $multiSelect = false;
    protected array $selectedOptions = [];

    public function addOption(string $value,$name = ''):self{
        if($this->multiple){
            $this->options[$value] = $value;
        }else{
            $this->options[$value] = $name;
        }
        return $this;
    }

    public function addOptionWithArray(array $values,$name = ''):self{
        $key = serialize($values);
        $this->options[$key] = $name;
        return $this;
    }

    public function addArrayOptions(array $values,string $key,string|\Closure $name):self{
        foreach ($values as $row) {
            $this->options[$row[$key]] = $row[$name];
        }
        return $this;
    }

    public function addOptionsFromModels(array $models,string $key,string|\Closure $name):self{
        foreach($models as $model){
            if($name instanceof \Closure){
                $this->options[$model->{$key}] = $name($model);
                continue;
            }
            $this->options[$model->{$key}] = $model->{$name};
        }
        return $this;
    }

    public function getOptions():array{
        return $this->options;
    }

    public function setSelectedOption(string $value,string $label):self{
        $this->selectedOptions[$value] = $label;
        return $this;
    }    

    public function setMultiple(bool $multiple):self{
        $this->multiple = $multiple;
        $this->addAttr('multiple','multiple');
        return $this;
    }

    public function setMultiSelect(bool $bool):self{
        $this->multiSelect = $bool;
        return $this;
    }

}