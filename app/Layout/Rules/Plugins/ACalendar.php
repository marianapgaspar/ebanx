<?php
namespace App\Layout\Rules\Plugins;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Form\AForm;
use Closure;

abstract class ACalendar extends AComponent{
    protected $form;

    protected array $events = [];

    protected string $dateField = '';

    protected string $descriptionField = '';

    protected string $id = '';

    public function __construct(ALayout $layout,AForm $form = null)
    {
        parent::__construct($layout);
    
        $this->form = $form;
    }

    public function getForm():AForm|null{
        if ($this->form){
            return $this->form;
        }
        return null;
    }

    public function setEvents(array $events,string $dateField,string $descriptionField,string $id):self{
        $this->events = $events;
        $this->dateField = $dateField;
        $this->descriptionField = $descriptionField;
        $this->id = $id;
        return $this;
    }
}