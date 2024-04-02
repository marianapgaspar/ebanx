<?php 

namespace App\Layout\Rules\Components;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Factory;

abstract class ACard extends AComponent{

    protected string $name = '';

    protected int $size = 6;

    protected string $imagem = '';

    protected $imageHeight = '';

    protected string $title = '';

    protected string $subtitle = '';

    protected string $texto = '';

    protected string $link = '';

    protected string $bodyId = '';

    protected string $titleLink = 'Link';

    protected string $txtColor = 'black';

    protected string $backgroundColor = '';

    protected string $body = '';

    protected string $footer = '';

    protected array $buttonLinks = [];
    protected array $data = [];

    protected array $links = [];

    public function __construct(ALayout $layout, string $name)
    {
        $this->name = $name;
        $this->addAttr('name',$name);
        parent::__construct($layout);
       
    }

    public function getName():string{
        return $this->name;
    }
    public function setTexto(string $texto = ''){
        $this->texto = $texto;
        return $this;
    }

    public function setSize(int $size){
        $this->size = $size;
        return $this;
    }

    public function setBody(string $body){
        $this->body = $body;
        return $this;
    }

    public function addFooter(string $footer):self {
        $this->footer = $footer;
        return $this;
    }
    public function setImagem(string $imagem = ''){
        $this->imagem = $imagem;
        return $this;
    }
    public function setImageHeight(int $height){
        $this->imageHeight = $height;
        return $this;
    }
    public function setTitle(string $title){
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle){
        $this->subtitle = $subtitle;
        return $this;
    }

    // public function setLink(string $link, $titleLink){
    //     $this->link = $link;
    //     $this->titleLink = $titleLink;
    //     return $this;
    // }

    public function setColor(string $backgroundColor, $txtColor = 'white'){
        $this->backgroundColor = $backgroundColor;
        $this->txtColor = $txtColor;
        return $this;
    }

    public function buttonLink(string $name,string $url,string $icon):self{
        
        $this->buttonLinks[] = ['name'=>$name,'url'=>$url,'icon'=>$icon];
        return $this;
    }
    function link(string $name,string $url,string $color,string $icon, string $target = ""):self{
        
        $this->links[] = ['name'=>$name,'url'=>$url,'color'=>$color, 'target' => $target,"icon"=>$icon];
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
    function setBodyId(string $id):self {
        $this->bodyId = $id;
        return $this;
    }
}