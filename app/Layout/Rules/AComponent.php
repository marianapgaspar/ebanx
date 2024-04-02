<?php

namespace App\Layout\Rules;

abstract class AComponent{

    protected ALayout $layout;


    protected array $attrs = [];
    protected bool $editor = false;
    protected string $class = "form-control";

    public function __construct(ALayout $layout)
    {
        $this->layout = $layout;
        $this->prepare();
    }

    public function prepare(){

    }

    public function addAttr(string $name, string|bool $value):self{
        $this->attrs[$name] = $value;
        return $this;
    }
    public function addClass(string $name):self{
        $this->class.= " ".$name;
        return $this;
    }
    public function isEditor(bool $bool):self{
        $this->editor = $bool;
        return $this;
    }

    public function getEditor():bool{
        return $this->editor;
    }

    abstract function html():string;

    public function getLayout():ALayout{
        return $this->layout;
    }

    public function getAttr():array{
        return $this->attrs;
    }

}