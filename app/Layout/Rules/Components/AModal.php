<?php
namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;

abstract class AModal extends AComponent{
    protected string $id = "modal-component";
    protected string $title = ""; 
    protected string $body = "";
    protected string $size = "md";
    protected array $buttons = array();

    public function setId(string| int $id){
        $this->id = $id;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }
    public function setSize(string $size){
        $this->size = $size;
    }

    public function setBody(String $body){
        $this->body= $body;
    }

    public function setButtons(Array $buttons){
        $this->buttons= $buttons;
    }


}