<?php

namespace App\Layout\Rules\Buttons;

use App\Layout\Rules\ALayout;

abstract class ALink extends AButton
{
    public function __construct(ALayout $layout, string $name,string $type = self::BUTTON_DEFAULT)
    {
        parent::__construct($layout, $name, $type);
        $this->addAttr('href',"javascript:void(0)");
    }
}