<?php

namespace App\Layout\Rules\Buttons;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;

abstract class AButton extends AComponent{

    const BUTTON_DEFAULT = 'default';
    const BUTTON_SUCCESS = 'success';
    const BUTTON_DANGER = 'danger';

    const BUTTON_PRIMARY = 'primary';

    const BUTTON_SECONDARY = 'secondary';

    const BUTTON_WARNING = 'warning';

    const BUTTON_INFO = 'info';

    const BUTTON_LIGHT = 'light';

    const BUTTON_DARK = 'dark';
    
    const BUTTON_OUTLINE_PRIMARY = 'outline-primary';

    const BUTTON_OUTLINE_SECONDARY = 'outline-secondary';

    const BUTTON_OUTLINE_SUCCESS = 'outline-success';

    const BUTTON_OUTLINE_DANGER = 'outline-danger';

    const BUTTON_OUTLINE_WARNING = 'outline-warning';

    const BUTTON_OUTLINE_INFO = 'outline-info';

    const BUTTON_OUTLINE_LIGHT = 'outline-light';

    const BUTTON_OUTLINE_DARK = 'outline-dark';


    private string $name;

    private string $type;
    public function __construct(ALayout $layout, string $name,string $type = self::BUTTON_DEFAULT)
    {
        parent::__construct($layout);
        $this->name = $name;
        $this->type = $type;
    }

    public function getName():string{
        return $this->name;
    }

    public function getType():string{
        return $this->type;
    }

}