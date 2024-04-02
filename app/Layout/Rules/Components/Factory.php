<?php

namespace App\Layout\Rules\Components\Inputs;

use App\Layout\Rules\ALayout;
use App\Layout\Rules\Components\Inputs\Themes\Clear\Input;

class Factory{
    private string $theme = 'Clear';

    private string $namespace = '\App\Layout\Rules\Components\Inputs\Themes\{theme}\{input}';

    private ALayout $layout;

    public function __construct(ALayout $layout,string $theme = 'Clear')
    {
        $this->theme = $theme;
        $this->layout = $layout;
    }

    private function getNamespace(string $theme, string $input):string{
        return str_replace(['{theme}','{input}'],[$theme,$input],$this->namespace);
    }


    public function input( string $name):AInput{
        $namespace = $this->getNamespace($this->theme,'Input');
        return new $namespace($this->layout,$name);
    }
    public function modal(string $name):AModal{
        $namespace = $this->getNamespace($this->theme,'Modal');
        return new $namespace($this->layout,$name);
    }

    public function select(string $name):ASelect{
        $namespace = $this->getNamespace($this->theme,'Select');
        return new $namespace($this->layout,$name);
    }
    public function checkbox(string $name):ACheckbox{
        $namespace = $this->getNamespace($this->theme,'Checkbox');
        return new $namespace($this->layout,$name);
    }
    public function radio(string $name):ARadio{
        $namespace = $this->getNamespace($this->theme,'Radio');
        return new $namespace($this->layout,$name);
    }

    public function editor(string $name):AEditor{
        $namespace = $this->getNamespace($this->theme,'Editor');
        return new $namespace($this->layout,$name);
    }

    public static function instance(ALayout $layout, string $theme = 'Clear'):Factory{
        return new Factory($layout,$theme);
    }

}