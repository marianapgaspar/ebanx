<?php
namespace App\Layout\Rules\Components;


abstract class ARadio extends AInput{

    protected string $values = '';
    protected array $fields = [];


    public function setFields(array $fields):self{
        $this->fields = $fields;
        return $this;
    }

    /**
     * Incluir os valores selecionados
     * @author Felipe Corassari
     * @param array $values
     * @return self
     */
    public function setValues(string $values):self{
        $this->values = $values;
        return $this;
    }
}