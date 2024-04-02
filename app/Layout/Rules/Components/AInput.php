<?php
namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;

abstract class AInput extends AComponent{
    protected string $name = "";

    protected string|array $value = "";
    protected bool $showLabel = true;

    public function __construct(ALayout $layout, string $name)
    {
        $this->name = $name;
        $this->addAttr('name',$name);
        parent::__construct($layout);
       
    }

    public function setShowLabel(bool $_bool):self{
        $this->showLabel = $_bool;
        return $this;
    }

    public function setValue(string|array $value):self{
        if(is_string($value)){
            $this->addAttr('value',$value);
        }
        
        $this->value = $value;
        return $this;
    }

    public function getName():string{
        return $this->name;
    }

    
}