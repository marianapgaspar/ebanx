<?php
namespace App\Layout\Rules;

use App\Layout\Interfaces\ITheme;
use App\Localisation\Rules\Dictionary;
use App\Localisation\Rules\Localisation;

abstract class ALayout implements ITheme{
    protected array $js = [];
    protected string $scripts = '';
    protected array $css = [];
    protected string $title = '';
    protected string $template = '';
    protected Dictionary $dictionary;

    public function __construct(Dictionary $dictionary = null)
    {
        
        if($dictionary === null){
            $this->dictionary = Localisation::instance()->getDictionary();
            $this->prepare();
            return;
        }
        $this->dictionary = $dictionary;
        
        $this->prepare();
    }
    public function prepare(){

    }
    public function addJs(string $js):self{
        if(in_array($js,$this->js)){
            return $this;
        }
        $this->js[] = $js;
        return $this;
    }

    public function addCss(string $css):self{
        if(in_array($css,$this->css)){
            return $this;
        }
        $this->css[] = $css;
        return $this;
    }

    public function setTitle(string $title):self{
        $this->title = $title;
        return $this;
    }

    public function setTemplate(string $template):self{
        
        $this->template = $template;
        return $this;
    }

    public function getDictionary():Dictionary{
        return $this->dictionary;
    }

    public function addScript(string $script):self{
        $this->scripts .= $script;
        return $this;
    }

}