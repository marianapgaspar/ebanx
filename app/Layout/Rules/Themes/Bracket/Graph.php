<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Gadgets\AGraphs;

class Graph extends AGraphs {
    public function html():string{
        $html = "
            <div style='height: {$this->height}px;'> 
            <canvas id='{$this->name}'></canvas>
            </div>
        ";
        $dataSets = $this->dataSet;
        if (!$this->dataSet){
            $dataSets = "{
            label:' ',
            backgroundColor:{$this->backgroundColor},
            borderColor: '{$this->borderColor}',
            data:{$this->data}}";
           
        }
        $this->getLayout()->addScript("
        var legendMargin = {
            id: 'legendMargin',
            beforeInit(chart,legend, options){
                const fitValue = chart.legend.fit;
                chart.legend.fit = function fit(){
                    fitValue.bind(chart.legend)();
                    return this.height += {$this->marginHeight}; 
                }
            }
        };
        var ctx = document.getElementById('{$this->name}').getContext('2d');
        var chart = new Chart(ctx, {
            type: '{$this->type}',
            data: {
                labels:{$this->labels},
                datasets: [{$dataSets}]},
                plugins: [ChartDataLabels{$this->margin}],
                options: {
                    {$this->options}
                }                
        });           
        ");
        return $html;
    }
    public function prepare(){
        $this->layout->addJs("https://cdn.jsdelivr.net/npm/chart.js");
        $this->layout->addJs("https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2");

    }
}