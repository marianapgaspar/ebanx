<?php

namespace App\Layout\Rules;

use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Buttons\AButtonGroup;
use App\Layout\Rules\Buttons\ALink;
use App\Layout\Rules\Cards\ACards;
use App\Layout\Rules\Components\ACard;
use App\Layout\Rules\Form\AForm;
use App\Layout\Rules\Components\ACheckbox;
use App\Layout\Rules\Components\ARadio;
use App\Layout\Rules\Components\ADate;
use App\Layout\Rules\Components\ADatetime;
use App\Layout\Rules\Components\AEditor;
use App\Layout\Rules\Components\AHidden;
use App\Layout\Rules\Components\AHtml;
use App\Layout\Rules\Components\AImage;
use App\Layout\Rules\Components\AInput;
use App\Layout\Rules\Components\AInputCep;
use App\Layout\Rules\Components\AOrderedMap;
use App\Layout\Rules\Components\ASelect;
use App\Layout\Rules\Components\ASelect2;
use App\Layout\Rules\Components\ATextarea;
use App\Layout\Rules\Components\ACrmSearch;
use App\Layout\Rules\Components\AModal;
use App\Layout\Rules\Components\AReport;
use App\Layout\Rules\Table\ATable;
use App\Layout\Rules\Dashboard\ADashboard;
use App\Layout\Rules\Errors\AErrors;
use App\Layout\Rules\Gadgets\AGraphs;
use App\Layout\Rules\Gadgets\ASteps;
use App\Layout\Rules\Treetable\ATreetable;
use App\Layout\Rules\Login\ALogin;
use App\Layout\Rules\Plugins\ACalendar;

class Factory{
    protected static $FACTORY_INSTANCE = null;
    protected string $theme = 'Clear';

    protected string $namespace = '\App\Layout\Rules\Themes\{theme}\{component}';

    public function __construct(string $theme = 'AdminLTE')
    {
        $this->theme = $theme;
    }
    protected function getNamespace(string $theme, string $component):string{
        return str_replace(['{theme}','{component}'],[$theme,$component],$this->namespace);
    }

    public function dashboard():ADashboard{
        $namespace = $this->getNamespace($this->theme,'Dashboard');
        return new $namespace();
    }

    public function login():ALogin{
        $namespace = $this->getNamespace($this->theme,'Login');
        return new $namespace();
    }

    public function button(ALayout $layout,string $name,string $type = AButton::BUTTON_SUCCESS):AButton{
        $namespace = $this->getNamespace($this->theme,'Button');
        return new $namespace($layout, $name, $type);
    }

    public function link(ALayout $layout,string $name,string $type = AButton::BUTTON_SUCCESS):ALink{
        $namespace = $this->getNamespace($this->theme,'Link');
        return new $namespace($layout, $name, $type);
    }

    public function buttonGroup(ALayout $layout,string $name):AButtonGroup{
        $namespace = $this->getNamespace($this->theme,'ButtonGroup');
        return new $namespace($layout,$this, $name);
    }
    public function checkbox(ALayout $layout,string $name):ACheckbox{
        $namespace = $this->getNamespace($this->theme,'Checkbox');
        return new $namespace($layout, $name);
    }
    public function radio(ALayout $layout,string $name):ARadio{
        $namespace = $this->getNamespace($this->theme,'Radio');
        return new $namespace($layout, $name);
    }

    public function input(ALayout $layout,string $name):AInput{
        $namespace = $this->getNamespace($this->theme,'Input');
        return new $namespace($layout, $name);
    }

    public function inputCep(ALayout $layout,string $name):AInputCep{
        $namespace = $this->getNamespace($this->theme,'InputCep');
        return new $namespace($layout, $name);
    }    

    public function textarea(ALayout $layout,string $name):ATextarea{
        $namespace = $this->getNamespace($this->theme,'Textarea');
        return new $namespace($layout, $name);
    }
    public function date(ALayout $layout,string $name):ADate{
        $namespace = $this->getNamespace($this->theme,'Date');
        return new $namespace($layout, $name);
    }
    public function datetime(ALayout $layout,string $name):ADatetime{
        $namespace = $this->getNamespace($this->theme,'Datetime');
        return new $namespace($layout, $name);
    }
    public function select(ALayout $layout,string $name):ASelect{
        $namespace = $this->getNamespace($this->theme,'Select');
        return new $namespace($layout, $name);
    }
    public function orderedMap(ALayout $layout,string $name):AOrderedMap{
        $namespace = $this->getNamespace($this->theme,'OrderedMap');
        return new $namespace($layout, $name);
    }


    public function select2(ALayout $layout,string $name):ASelect2{
        $namespace = $this->getNamespace($this->theme,'Select2');
        return new $namespace($layout, $name);
    }
    public function image(ALayout $layout,string $name):AImage{
        $namespace = $this->getNamespace($this->theme,'Image');
        return new $namespace($layout, $name);
    }
    public function hidden(ALayout $layout,string $name):AHidden{
        $namespace = $this->getNamespace($this->theme,'Hidden');
        return new $namespace($layout, $name);
    }
    public function html(ALayout $layout,string $name):AHtml{
        $namespace = $this->getNamespace($this->theme,'Html');
        return new $namespace($layout, $name);
    }
    public function editor(ALayout $layout,string $name):AEditor{
        $namespace = $this->getNamespace($this->theme,'Editor');
        return new $namespace($layout, $name);
    }
    public function form(ALayout $layout,string $action,string $method = 'POST',bool $ajax = false):AForm{
        $namespace = $this->getNamespace($this->theme,'Form');
        return new $namespace($layout, $action,$this,$method,$ajax);
    }
    public function table(ALayout $layout):ATable{
        $namespace = $this->getNamespace($this->theme,'Table');
        return new $namespace($layout,$this);
    }
    public function crmSearch(ALayout $layout):ACrmSearch{
        $namespace = $this->getNamespace($this->theme,'CrmSearch');
        return new $namespace($layout);
    }

    public function modal(ALayout $layout):AModal{
        $namespace = $this->getNamespace($this->theme,'Modal');
        return new $namespace($layout);
    }

    public function step(ALayout $layout):ASteps{
        $namespace = $this->getNamespace($this->theme,'Step');
        return new $namespace($layout,$this);
    }

    public function error():AErrors{
        $namespace = $this->getNamespace($this->theme,'Error');
        return new $namespace();
    }

    public function calendar(ALayout $layout,AForm $form=null):ACalendar{
        $namespace = $this->getNamespace($this->theme,'Calendar');
        return new $namespace($layout,$form);
    }
    public function card(ALayout $layout,string $name):ACard{
        $namespace = $this->getNamespace($this->theme,'Card');
        return new $namespace($layout, $name);
    }
    public function graph(ALayout $layout):AGraphs{
        $namespace = $this->getNamespace($this->theme,'Graph');
        return new $namespace($layout,$this);
    }
    public function treetable(ALayout $layout, array $columns, array $dados):ATreetable{
        $namespace = $this->getNamespace($this->theme,'Treetable');
        return new $namespace($layout,$this,$columns,$dados);
    }
    public function cards(ALayout $layout):ACards{
        $namespace = $this->getNamespace($this->theme,'Cards');
        return new $namespace($layout,$this);
    }
    public function report(ALayout $layout):AReport{
        $namespace = $this->getNamespace($this->theme,'Report');
        return new $namespace($layout,$this);
    }
    public static function instance():Factory{
        if(self::$FACTORY_INSTANCE == null){
            self::$FACTORY_INSTANCE = new Factory();
        }
        return self::$FACTORY_INSTANCE;
    }
}