<?php
namespace App\Layout\Rules\Components;


abstract class ACheckbox extends AInput{

    protected array $values = [];
    protected array $fields = [];

    protected array $groupFields = [];


    public function setFields(array $fields):self{
        $this->fields = $fields;
        return $this;
    }
    public function setGroupFields(string $group,array $fields):self{
        $this->groupFields[$group] = $fields;
        return $this;
    }


    /**
     * Incluir os valores selecionados
     * @author Felipe Corassari
     * @param array $values
     * @return self
     */
    public function setValues(array $values):self{
        $this->values = $values;
        return $this;
    }
}