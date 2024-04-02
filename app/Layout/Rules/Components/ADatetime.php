<?php
namespace App\Layout\Rules\Components;

abstract class ADatetime extends AInput{
    protected string $type = 'datetime-local';
    
    public function setType(string $type):self{
        $this->type = $type;
        return $this;
    }
}