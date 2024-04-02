<?php

namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;

abstract class AOrderedMap extends ASelect{
    const INPUT_COMPONENT = 'input_component';
    const SELECT_COMPONENT = 'select_compoment';



    protected array $map = [];
    protected string $functionName = '';
    public function setMap(array $map):self{
        $this->map = $map;
        $this->prepareMap();
        return $this;
    }

    public function prepareMap(){

    }

}