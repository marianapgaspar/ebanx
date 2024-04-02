<?php

namespace App\Layout\Rules\Table;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Form\AForm;
use App\Layout\Rules\Factory;
use System\DataBase\Entities\Conditionals;
use System\Models\TableModel;

abstract class ATable extends AComponent{

    protected array $columns = [];

    protected array $data = [];

    protected array $links = [];

    protected bool $hasNavLinks = false;
    protected string $name = '';
    protected array $navLinks = [];

    protected array $dataCallbacks = [];

    protected array $buttons = [];

    protected array $ordenableColumns = [];

    protected array $orders = [];

    protected Paginate $paginate;

    protected AForm $filter;

    protected bool $hasFilter = false;
    protected Factory $factory;

    protected string $url='';

    protected array $uri = [];

    protected bool $filterField = false;

    protected bool $hasPaginate = false;

    protected array $searchField = [];

    protected string $nextLink =  '';

    protected string $beforeLink = '';

    public function __construct(ALayout $layout,Factory $factory)
    {
        parent::__construct($layout);
        $this->paginate = new Paginate();
        $this->factory = $factory;
    }

    public function addButton(AButton $button){
        $this->buttons[] = $button;
    }
    
    public function setColumns(array $columns):self{
        $this->columns = $columns;
        return $this;
    }
    public function setOrdenableColumns(array $columns):self{
        $this->ordenableColumns = $columns;
        return $this;
    }

    public function setData(array $data):self{
        $this->data = $data;
        return $this;
    }

    public function filter(string $url):AForm{
        $this->hasFilter = true;
        
        $this->filter = $this->factory->form($this->layout,$url,'GET',false);
        $this->filter->setName('filters');
        $this->filter->addButton($this->factory->button($this->layout,'search',AButton::BUTTON_OUTLINE_PRIMARY));
        return $this->filter;
    }

    public function getData():array{
        return $this->data;
    }

    public function getColumns():array{
        return $this->columns;
    }

    public function addLink( $type,string $icon, \Closure $link,\Closure $message =null, \Closure $show =null, string $attr = ""):self{
        $this->links[] = ['type'=>$type,'icon'=>$icon,'link'=>$link,'message'=>$message,'show'=>$show, 'attr'=>$attr];
        return $this;
    }
    public function getLinks():array{
        return $this->links;
    }

    function addCallback(string $name, \Closure $callback):self{
        $this->dataCallbacks[$name] = $callback;
        return $this;
    }

    public function getCallbacks():array{
        return $this->dataCallbacks;
    }

    public function getButtons():array{
        return $this->buttons;
    }

    public function searchFields(array $fields):self{
        $this->filterField = true;
        $this->searchField = $fields;
        return $this;
    }

    public function paginate(TableModel $model,string $url,int $page,int $perPage = 20,array $uri = []){
        $this->hasPaginate = true;
        $this->orders = isset($uri['orders'])?$uri['orders']:[];
        foreach($this->orders as $field=>$direction){
            $model->query()->orderBy($field,$direction);
        }
        if($this->filterField && isset($uri['search'])){
            $conditionals = new Conditionals;
            foreach($this->searchField as $field){
                $conditionals->orLike($field,"%{$uri['search']}%");
            }
            $model->query()->group($conditionals);
        }
        $this->uri = $uri;
        $this->url = $url;
        $this->paginate->create($model,$url,$page,$perPage,$uri);
        $this->data = $this->paginate->getData();
    }

    public function getPagination():Paginate{
        return $this->paginate;
    }

    public function hasFilter():bool{
        return $this->hasFilter;
    }

    public function getFilter():AForm{
        return $this->filter;
    }

    function navLink(string $name,string $url):self{
        $this->hasNavLinks = true;
        $this->navLinks[] = ['name'=>$name,'url'=>$url];
        return $this;
    }
    public function hasNavLinks():bool{
        return $this->hasNavLinks;
    }
    function setActive(string $url): string{
        $URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ($url == $URL_ATUAL){
            $active = 'active';
          } else {
            $active = 'tx-gray-light';
          }
        return $active;
    }
    public function getNextLink(){
        $nextPage = $this->getPagination()->getPage() + 1;
        foreach ($this->getPagination()->getLinks() as $link){
            if (array_search($nextPage, $link)){
            $this->nextLink = $link["link"];
            }
        }
        return $this->nextLink;
    }
    public function getBeforeLink(){
        $beforePage = $this->getPagination()->getPage() - 1;
        foreach ($this->getPagination()->getLinks() as $link){
            if (array_search($beforePage, $link)){
            $this->beforeLink = $link["link"];
            }
        }
        return $this->beforeLink;
    }

}