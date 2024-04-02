<?php
namespace App\Layout\Rules\Form;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Buttons\AButtonGroup;
use App\Layout\Rules\Components\ACheckbox;
use App\Layout\Rules\Components\ARadio;
use App\Layout\Rules\Components\ADate;
use App\Layout\Rules\Components\ADatetime;
use App\Layout\Rules\Components\AInput;
use App\Layout\Rules\Components\ASelect;
use App\Layout\Rules\Components\AEditor;
use App\Layout\Rules\Components\AHidden;
use App\Layout\Rules\Components\AHtml;
use App\Layout\Rules\Components\AImage;
use App\Layout\Rules\Components\AOrderedMap;
use App\Layout\Rules\Components\ASelect2;
use App\Layout\Rules\Components\ATextarea;
use App\Layout\Rules\Components\AInputCep;
use App\Layout\Rules\Factory;
use System\Models\AModel;

abstract class AForm  extends AComponent{
    protected string $name = '';
    protected array $inputs = [];

    protected array $buttonsGroups = [];
    protected array $buttons = [];
    protected array $links = [];
    protected array $sizes = [];

    protected Factory $factory;

    protected string $action = '';

    protected string $method = '';
    protected string $id = '';
    protected bool $ajax = false;

    protected array $showIf = [];
    protected array $dontShowIf = [];
    protected int $col = 12;

    protected bool $confirm = false;

    protected string $redirectUrl = "";

    public function __construct(ALayout $layout,string $action,Factory $factory,string $method = 'POST',$ajax = false)
    {
        $this->ajax = $ajax;
        $this->factory = $factory;
        
        $this->action = $action;
        $this->method = $method;
        $this->id = uniqid('form_');

        $this->addAttr('action',$this->action);
        $this->addAttr('method',$this->method);
        $this->addAttr('id',$this->id);
        parent::__construct($layout);

    }

    public function redirect(string $url):self{
        $this->redirectUrl = $url;
        return $this;
    }
    public function setAjax(bool $ajax):self{
        $this->ajax = $ajax;
        return $this;
    }
    public function setName(string $name):self{
        $this->name = $name;
        return $this;
    }
    public function getName():string{
        return $this->name;
    }
    function addButton(AButton $button):self{
        $this->buttons[] = $button;
        return $this;
    }
    function loadData(AModel $model){
        foreach($model->getFields() as $field){
            if(!isset($this->inputs[$field])){
                continue;
            }
            $this->inputs[$field]->setValue((string)($model->{$field}));
        }
    }
    function loadDataArray(array $data):self{
        foreach($this->inputs as $name=>$input){
            if(isset($data[$name])){
                $input->setValue($data[$name]);
            }
        }
        return $this;
    }
    function getButtons():array{
        return $this->buttons;
    }

    function addInput(AInput $input, int $size = 6):self{
        $this->inputs[$input->getName()] = $input;
        $this->sizes[$input->getName()] = $size;
        return $this;
    }
    function getInputs():array{
        return $this->inputs;
    }

    function getInput(string $name):AInput{
        return $this->inputs[$name];
    }

    function getSelect(string $name):ASelect{
        return $this->inputs[$name];
    }
    function getSelect2(string $name):ASelect2{
        return $this->inputs[$name];
    }
    function editor(string $name, int $size = 6):AEditor{
        $input = $this->factory->editor($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }

    function getComponents():array{
        return $this->inputs;
    }
    function getSizes():array{
        return $this->sizes;
    }
    function getButtonsGroups():array{
        return $this->buttonsGroups;
    }

    function input(string $name, int $size = 6):AInput{
        $input = $this->factory->input($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function textarea(string $name, int $size = 6):ATextarea{
        $input = $this->factory->textarea($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function inputCep(string $name, int $size = 6):AInputCep{
        $input = $this->factory->inputCep($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function hidden(string $name, int $size = 6):AHidden{
        $input = $this->factory->hidden($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function append(string $name, int $size = 6):AHtml{
        $input = $this->factory->html($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function date(string $name, int $size = 6):ADate{
        $input = $this->factory->date($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function datetime(string $name, int $size = 6):ADatetime{
        $input = $this->factory->datetime($this->layout,$name);
        $this->addInput($input,$size);
        return $input;
    }
    function select(string $name, int $size = 6):ASelect{
        $select = $this->factory->select($this->layout,$name);
        $this->addInput($select,$size);
        return $select;
    }
    function orderedMap(string $name, int $size = 6):AOrderedMap{
        $select = $this->factory->orderedMap($this->layout,$name);
        $this->addInput($select,$size);
        return $select;
    }

    function select2(string $name, int $size = 6):ASelect2{
        $select = $this->factory->select2($this->layout,$name);
        $this->addInput($select,$size);
        return $select;
    }

    function showIf(string $input,string $value,array $fields){
        $this->showIf[$input][$value] = $fields;
    }
    function dontShowIf(string $input,string $value,array $fields){
        $this->dontShowIf[$input][$value] = $fields;
    }


    function checkbox(string $name, int $size = 6):ACheckbox{
        $checkbox = $this->factory->checkbox($this->layout,$name);
        $this->addInput($checkbox,$size);
        return $checkbox;
    }
    function radio(string $name, int $size = 6):ARadio{
        $radio = $this->factory->radio($this->layout,$name);
        $this->addInput($radio,$size);
        return $radio;
    }
    function image(string $name, int $size = 6):AImage{
        $checkbox = $this->factory->image($this->layout,$name);
        $this->addInput($checkbox,$size);
        return $checkbox;
    }

    function buttonGroup(string $name):AButtonGroup{
        $buttongroup = $this->factory->buttonGroup($this->layout,$name);
        $this->buttonsGroups[] = $buttongroup;
        return $buttongroup;
    }
    function button(string $name, string $type = AButton::BUTTON_DEFAULT):AButton{
        $button = $this->factory->button($this->layout,$name,$type);
        $this->addButton($button);
        return $button;
    }


    function link(string $name,string $url,string $color, string $target = ""):self{
        
        $this->links[] = ['name'=>$name,'url'=>$url,'color'=>$color, 'target' => $target];
        return $this;
    }
    
    function setActive(string $url): string{
        $URL_ATUAL= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ($url == $URL_ATUAL){
            $active = 'active';
          } else {
            $active = 'tx-gray-light';
          }
        return $active;
    }
    public function getId():string{
        return $this->id;
    }
}