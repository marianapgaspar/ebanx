<?php 

namespace App\Layout\Rules\Gadgets;

abstract class ASteps extends AGraphs{
    protected array $steps = [];
    protected array $titles = [];

    //Adiciona as etapas e dita o status
    public function addStep(string $name, bool $status):self{
        $this->steps[$name] = $status;
        return $this;
    }

    //Criando o conjunto de etapas
    public function addSteps(array $steps):self {
        foreach ($steps as $step){
            $this->addStep($step, false);
        }
        return $this;
    }
    
    //Para definir onde está o status
    public function setStatus($step):self {
        foreach ($this->steps as $name=>$status){
            $this->addStep($name, true);
            if ($name == $step){
                break;
            }
        }
        return $this;
    }
    public function getSteps():array{
        return $this->steps;
    }
    public function getStatus($step){
        if (isset($this->steps[$step])){
            return $this->steps[$step];
        }
        return false;
    }



    public function addTitles(array $titles):self{
        $this->titles = $titles;
        return $this;
    }
    public function getTitles():array{
        return $this->titles;
    }
}