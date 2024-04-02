<?php
namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;

abstract class ADate extends AInput{
    protected string $format = 'dd/mm/yy';
    
    public function setFormat(string $format):self{
        $this->format = $format;
        return $this;
    }
}