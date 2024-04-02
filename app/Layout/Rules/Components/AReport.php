<?php
namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;

// use App\Layout\Rules\AComponent;
// use App\Layout\Rules\ALayout;


abstract class AReport  extends AComponent{
    protected array $data = [];
    protected array $columns = [];
    protected string $title = '';

    public function setTable(array $data):self{
        $this->data = $data;
        return $this;
    }
    public function setColumns(array $columns):self{
        $this->columns = $columns;
        return $this;
    }
    public function setTitle(string $title):self{
        $this->title = $title;
        return $this;
    }
}