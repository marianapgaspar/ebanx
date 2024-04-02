<?php 

namespace App\Layout\Rules\Treetable;

use App\Layout\Models\Treetable;
use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Factory;
use App\Layout\Rules\TreetableConstruct;

abstract class ATreetable extends AComponent{
    protected array $columns = [];
    protected array $dados = [];


    public function __construct(ALayout $layout,Factory $factory,array $columns,array $dados)
    {
        parent::__construct($layout);
        $this->factory = $factory;
        $this->columns = $columns;
        $this->dados = $dados;
    }
}