<?php 

namespace App\Layout\Rules\Gadgets;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Factory;

abstract class AGraphs extends AComponent{

    protected string $name = '';

    protected string $type = 'bar';

    protected string $labels = '';

    protected string $label = '';

    protected string $parser = '';

    protected string $data = '';
    
    protected string $options = '';

    protected string $backgroundColor = '["#00a3ba","#00b644","#fc574c","#f59f00","#00bdf1","#d3d5de"]';

    protected string $borderColor =  '';
   
    protected string $dataSet =  '';
    
    protected string $height =  '';
    protected string $margin =  '';
    protected string $marginHeight =  '0';

    public function __construct(ALayout $layout,Factory $factory)
    {
        parent::__construct($layout);
        $this->factory = $factory;
    }

    public function addGraph(string $name, string $type){
        $this->name = $name;
        $this->type = $type;
      
        return $this;
    }
    public function setLabels( array $labels, string $label){
        $this->labels = "['".implode("','", $labels)."']";
        
        $this->label = $label;
        return $this;
    }

    public function setParser(array $parser){
        $this->parser = $parser;
        return $this;
    }

    public function setData(array $data){
        $this->data = "['".implode("','", $data)."']";
        return $this;
    }
    public function setBackGroundColor(array $backgroundColor){
        $this->backgroundColor = "['".implode("','", $backgroundColor)."']";
        return $this;
    }
    public function setBorderColor(string $borderColor){
        $this->borderColor = $borderColor;
        return $this;
    }
    public function setOptions(string $options){
        $this->options = $options;
        return $this;
    }
    public function setDataSet(string $dataSet){
        $this->dataSet = $dataSet;
        return $this;
    }
    public function setHeight(string $height){
        $this->height = $height;
        return $this;
    }
    public function setMarginLegend(string $height = '100'){
        $this->margin = ',legendMargin';
        $this->marginHeight = $height;
        return $this;
    }

}