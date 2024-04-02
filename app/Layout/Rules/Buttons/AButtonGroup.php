<?php

namespace App\Layout\Rules\Buttons;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Factory;

abstract class AButtonGroup extends AComponent{
    protected array $buttons = [];

    protected string $title = '';

    protected Factory $factory;

    public function __construct(ALayout $layout,Factory $factory,string $title)
    {
        parent::__construct($layout);
        $this->title = $title;
        $this->factory = $factory;
    }
    public function button(string $name, string $type = AButton::BUTTON_DEFAULT):AButton{
        $button = $this->factory->button($this->layout,$name,$type);
        $this->buttons[] = $button;
        return $button;
    }
    public function link(string $name, string $type = AButton::BUTTON_DEFAULT):ALink{
        $button = $this->factory->link($this->layout,$name,$type);
        $this->buttons[] = $button;
        return $button;
    }
    public function setTitle(string $title):self{
        $this->title = $title;
        return $this;
    }
}