<?php
namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;

abstract class ACrmSearch extends AComponent{
    protected string $name = "";
    protected string|array $value = "";
    protected bool $searchModal = false;
    protected bool $searchModalShow = false;
    protected int $searchCodEmitente=0;


    public function setSearchModal(bool $_bool){
        $this->searchModal = $_bool;
    }
    public function setSearchCodEmitente(int $_int){
        $this->searchCodEmitente = $_int;
    }
    public function setSearchModalShow(int $_bool){
        $this->searchModalShow = $_bool;
    }
 
}